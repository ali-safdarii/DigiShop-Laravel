<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AmazingSaleResource;
use App\Http\Resources\ProductResource;
use App\Models\Admin\Content\Banner;
use App\Models\Admin\Market\AmazingSale;
use App\Models\Admin\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Traits\ApiResponses;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class ProductApiController extends Controller
{
    use ApiResponses;


    public function index()
    {
        return ProductResource::collection(Product::paginate());
    }

    public function search(Request $request)
    {

        $query = $request->input('query');

        $results = Product::where('name', 'LIKE', "%$query%")
        ->orWhere('model_name', 'LIKE', "%$query%")
        ->paginate(24);

        if ($results->isEmpty()) {
            return response()->json(['message' => 'No matching products found.'], 404);
        }

       return ProductResource::collection($results);



    }




    public function searchDefault(Request $request)
    {

        $query = $request->input('query');

        $results = Product::where('name', 'LIKE', "%$query%")
        ->orWhere('model_name', 'LIKE', "%$query%")
        ->paginate(24);

        if ($results->isEmpty()) {
            return response()->json(['message' => 'No matching products found.'], 404);
        }

       return ProductResource::collection($results);
    }



    public function show($id)
    {
        $product = Product::findOrFail($id);
        $resource = new ProductResource($product);

        return $this->successResponse(data: $resource, message: "reciving product with id: [$product->id] is Sucessfully.");
    }


    public function related($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '<>', $id)
            ->take(10)
            ->get();

        return $this->successResponse(
            data: ['items' => ProductResource::collection($relatedProducts)]
        );
    }

    public function summeryProducts()
    {

        $products = Product::take(10)->get();


        return $this->successResponse(
            data: ['items' => ProductResource::collection($products)]
        );

    }

    public function amazingProducts()
    {

        try {
            $amazingProducts = AmazingSale::with('product')->take(10)->get();

            return $this->successResponse(
                data: ['items' => AmazingSaleResource::collection($amazingProducts)]
            );

        } catch (\Exception $e) {

            return $this->errorResponse(message: $e->getMessage(), code: 500);

        }
    }

    public function topVisited()
    {
        return $this->successResponse(
            data: 'hello world'
        );
    }


    public function banners()
    {
        $banners = Banner::where('status', 1)->get();

        return $this->successResponse(
            data: ['items' => $banners]
        );

    }


}
