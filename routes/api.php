<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BrandApiController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\CartItemApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {

    return \Illuminate\Support\Facades\Response::json([
        'message' => 'HelloWorld'
    ]);
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductApiController::class, 'index']);
    Route::get('/summaries', [ProductApiController::class, 'summeryProducts']);
    Route::get('/{id}', [ProductApiController::class, 'show']);
    Route::get('/{id}/related', [ProductApiController::class, 'related']);
   // Route::get('/search', [ProductApiController::class, 'search']);

});
Route::get('/search', [ProductApiController::class, 'search']);
Route::get('/search-default', [ProductApiController::class, 'searchDefault']);
Route::get('/amazing-products', [ProductApiController::class, 'amazingProducts']);

/*Route::get('/products',[ProductApiController::class,'index']);//->middleware('auth:sanctum');
Route::get('/summery-products',[ProductApiController::class,'summeryProducts']);//->middleware('auth:sanctum');
Route::get('/products/{id}',[ProductApiController::class,'show']);
Route::get('/products/{id}/related', [ProductApiController::class,'related']);
Route::get('/amazing-products', [ProductApiController::class,'amazingProducts']);
Route::get('/top-visited-products', [ProductApiController::class,'topVisited']);*/

Route::get('/banners', [ProductApiController::class, 'banners']);
Route::post('/logout', [AuthApiController::class, 'logout'])
    ->middleware('auth:sanctum');

/*Route::get('/categories', [CategoryApiController::class,'index']);
Route::get('/categories/all', [CategoryApiController::class,'all']);
Route::get('/category/{id}/product', [CategoryApiController::class,'productByCategory']);*/

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryApiController::class, 'index']);
    Route::get('/all', [CategoryApiController::class, 'all']);
    Route::get('/{id}/products', [CategoryApiController::class, 'productByCategory']);
});

/*Route::get('/brands', [BrandApiController::class,'index']);
Route::get('/brand/{id}/product', [BrandApiController::class,'productByBrand']);*/

Route::prefix('brands')->group(function () {
    Route::get('/', [BrandApiController::class, 'index']);
    Route::get('/{id}/products', [BrandApiController::class, 'productsByBrand']);
});


// Cart Routes
Route::prefix('carts')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [CartApiController::class, 'index']);
    //Route::get('/{cart}', [CartApiController::class, 'show']);
    Route::post('/create', [CartApiController::class, 'create']);
    Route::delete('/{cart}', [CartApiController::class, 'destroy']);

    //cart-items
    Route::post('/exsit-product', [CartApiController::class, 'isExsitProduct']);
    Route::get('/items', [CartApiController::class, 'cartItems']);
    Route::get('/items-count', [CartApiController::class, 'cartCountItems']);
    Route::post('/delete-item', [CartApiController::class, 'deleteProduct']);
    Route::patch('/update-item', [CartApiController::class, 'updateCartItem']);


});

/*// CartItem Routes
Route::prefix('cart-items')->group(function () {
    Route::post('/', [CartItemApiController::class, 'create']); // Add a new item to the cart
    Route::put('/{cartItem}', [CartItemApiController::class, 'update']); // Update details of a cart item
    Route::delete('/{cartItem}', [CartItemApiController::class, 'destroy']); // Remove a cart item
});*/

/*Route::middleware('throttle:resend-otp-limitter')->post('/send-otp', [AuthApiController::class, 'authentication']);
Route::middleware('throttle:resend-otp-limitter')->post('/verify/{token}', [AuthApiController::class, 'verify']);
Route::middleware('throttle:resend-otp-limitter')->post('/resend-otp/{token}', [AuthApiController::class, 'resendOtp']);*/

Route::middleware('throttle:resend-otp-limitter')->group(function () {
    Route::post('/send-otp', [AuthApiController::class, 'authentication']);
    Route::post('/verify/{token}', [AuthApiController::class, 'verify']);
    Route::post('/resend-otp/{token}', [AuthApiController::class, 'resendOtp']);
    Route::post('/loginOrRegister', [AuthApiController::class, 'loginOrRegister']);

});


