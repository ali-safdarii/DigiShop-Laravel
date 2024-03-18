<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartApiRequest;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\CartResource;
use App\Http\Traits\ApiResponses;
use App\Models\Admin\Cart\Cart;
use App\Models\Admin\Cart\CartItem;

use App\Models\Admin\Market\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartApiController extends Controller
{

    use ApiResponses;

    public function index()
    {
        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->get();

        return $this->successResponse(data: $carts);

    }


    public function cartItems()
    {

        try {
            if (!Auth::check())
                return $this->authErrorResponse();

            $userid = auth()->user()->id;

            $cart = Cart::where('user_id', $userid)->with('cartItems')->first();

            return $this->successResponse(
                data: new CartResource($cart),
            );

        } catch (\Exception $e) {

            return $this->errorResponse(message: $e->getMessage(), code: 500);

        }

    }


    public function create(Request $request)
    {
        $product_id = $request->input('product_id');
        $color_id = $request->input('color_id');
        $final_price = $request->input('final_price');
        $qty = $request->input('qty');


        try {

            if (!Auth::check())
                return $this->authErrorResponse();


            $userId = Auth::id();
            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart) {
                $cart = Cart::create(['user_id' => $userId]);
            }

            // Check if the product and color IDs already exist in the cart
            $existingCartItem = $cart->cartItems()
                ->where('user_id', $userId)
                ->where('product_id', $product_id)
                ->where('color_id', $color_id)
                ->first();

            if ($existingCartItem)
                return $this->errorResponse(message: 'این محصول قبلا به سبد خرید شما اضافه شده است', code: 400);

            $productColorExists = DB::table('product_colors')
                ->where('product_id', $product_id)
                ->where('color_id', $color_id)
                ->exists();
            if (!$productColorExists) {
                return $this->errorResponse(message: 'رنگ مورد نظر برای این محصول یافت نشد', code: 400);
            }


            $cartItem = new CartItem([
                'user_id' => $userId,
                'product_id' => $product_id,
                'color_id' => $color_id,
                'final_price' => $final_price,
                'qty' => $qty,
            ]);
            $user = Auth::user();
            $cart->user()->associate($user);
            $cart->cartItems()->save($cartItem);

            return $this->noDataSuccessResponse(message: 'محصول مورد نظر به سبد خرید شما اضافه شد', code: 201);

        } catch (\Exception $e) {
            return $this->errorResponse(message: $e->getMessage(), code: 500);
        }

    }

    // Controller method for updating cart item quantity
    public function updateCartItem(Request $request)
    {
        $product_id = $request->input('product_id');
        $color_id = $request->input('color_id');
        $final_price = $request->input('final_price');
        $qty = $request->input('qty');
        $userid = auth()->user()->id;
        try {


            if (!Auth::check())
                return $this->authErrorResponse();

            $cartItem = CartItem::where('product_id', $product_id)
                ->where('user_id', $userid)
                ->where('color_id', $color_id)
                ->first();

            if (!$cartItem)
                return $this->errorResponse(
                    message: 'محصولی با مشخصات مورد نظر یافت نشد.',
                    code: 404);


            $cartItem->final_price = $final_price;
            $cartItem->qty=$qty;
            $cartItem->save();

            return $this->noDataSuccessResponse(message: 'تعداد محصول مورد نظر شما بروزرسانی شد');


        } catch (\Exception $e) {
            return $this->errorResponse(message: $e->getMessage(), code: 500);
        }


    }


    // Check if the product is already in the cart.
    public function isExsitProduct(Request $request)
    {
        try {
            if (!Auth::check())
                return $this->authErrorResponse();

            $userId = Auth::id();
            $product_id = $request->input('product_id');
            $color_id = $request->input('color_id');


            $cartItem = CartItem::where('product_id', $product_id)
                ->where('user_id', $userId)
                ->where('color_id', $color_id)
                ->select('qty')
                ->first();

            $isExist = $cartItem !== null;
            $quantity = $isExist ? $cartItem->qty : null;
            $message = $isExist ? 'محصول مورد نظر در سبد خرید موجود است' : 'محصولی با مشخصات داده شده یافت نشد';

            return $this->successResponse(
                data: [
                    'isExist' => $isExist,
                    'qty' => $quantity,
                ],
                message: $message
            );
        } catch (\Exception $e) {
            return $this->errorResponse(message: $e->getMessage(), code: 500);

        }
    }

    public function cartCountItems()
    {
        try {

            if (!Auth::check())
                return $this->authErrorResponse();

            $userId = Auth::id();
            $cart = Cart::where('user_id', $userId)->first();
            $cartItemsCount = $cart->cartItems()->count();

            return $this->successResponse(
                data: [
                    'items_count' => $cartItemsCount,
                ],
                message: "تعداد محصول موجود در سبد خرید شما:$cartItemsCount"
            );
        } catch (\Exception $e) {
            return $this->errorResponse(message: $e->getMessage(), code: 500);

        }

    }


    public function deleteProduct(CartApiRequest $request)
    {
        $product_id = $request->input('product_id');
        $color_id = $request->input('color_id');


        try {
            if (!Auth::check())
                return $this->authErrorResponse();

            $userId = Auth::id();

            // Find the user's cart
            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart)
                return $this->errorResponse(message: 'کاربر مورد نظر بدون سبد خرید است', code: 404);


            // Find the cart item to delete
            $cartItem = $cart->cartItems()
                ->where('product_id', $product_id)
                ->where('color_id', $color_id)
                ->first();

            if (!$cartItem)
                return $this->errorResponse(
                    message: 'محصولی با مشخصات مورد نظر یافت نشد.',
                    code: 404);


            $cartItem->delete();
            return $this->noDataSuccessResponse(message: 'محصول مورد نظر با موفقیت از سبد خرید شما حذف شد.');

        } catch (\Exception $e) {
            return $this->errorResponse(message: $e->getMessage(), code: 500);
        }
    }


}


