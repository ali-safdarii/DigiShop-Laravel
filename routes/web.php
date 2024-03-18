<?php

use App\Http\Controllers\Admin\Content\BannerController;
use App\Http\Controllers\Admin\Content\PostCategoryController;
use App\Http\Controllers\Admin\Content\PostCommentController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Market\AmazingSaleController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\CategoryAttributeController;
use App\Http\Controllers\Admin\Market\CategoryValueController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\ProductCategoryController;
use App\Http\Controllers\Admin\Market\ProductCommentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Payment\PaymentController;
use App\Http\Controllers\Admin\User\AdminController;
use App\Http\Controllers\Admin\User\RoleController;

use App\Http\Livewire\Admin\Market\ColorTable;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('market')->group(function () {

        Route::resource('brand', BrandController::class, ['as' => 'market', 'except' => 'edit']);
        Route::resource('delivery', DeliveryController::class, ['as' => 'market', 'except' => 'edit']);
        Route::resource('category', ProductCategoryController::class, ['as' => 'market', 'except' => 'edit']);

        Route::resource('product', ProductController::class, ['as' => 'market', 'except' => 'edit']);
        Route::get('/{product}/gallery', [ProductController::class, 'galleryIndex'])->name('market.product.gallery.index');
        Route::get('/{product}/color', [ProductController::class, 'colorIndex'])->name('market.product.color.index');

    //    Route::get('/colors', ColorTable::class);
        Route::get('/Guarantees', ColorTable::class);

        Route::resource('attributes', CategoryAttributeController::class, ['as' => 'market']);
        Route::resource('attributes.value', CategoryValueController::class, ['as' => 'market']);

        Route::post('/comments/{comment}/toggle-approval', [ProductCommentController::class, 'toggleApproval'])
            ->name('comments.toggle-approval');
        Route::resource('comments', ProductCommentController::class, ['as' => 'market']);

        Route::resource('payments', PaymentController::class, ['as' => 'market','except' => 'edit']);

        Route::resource('discounts', DiscountController::class, ['as' => 'market','except' => 'edit']);

        Route::resource('amazing-sale', AmazingSaleController::class, ['as' => 'market','except' => 'edit']);

    })->namespace('Admin\Market');

    Route::prefix('content')->group(function () {

        Route::resource('postCategory', PostCategoryController::class, ['as' => 'content' ,'except' => 'edit']);
        Route::resource('banners', BannerController::class, ['as' => 'content' ,'except' => 'edit']);
        Route::resource('post', PostController::class, ['as' => 'content' ,'except' => 'edit']);
        Route::prefix('comment')->group(function () {
            Route::get('/', [PostCommentController::class, 'index'])->name('content.comment.index');
            Route::get('/create', [PostCommentController::class, 'create'])->name('content.comment.create');
            Route::get('/{comment}', [PostCommentController::class, 'show'])->name('content.comment.show');
        });

    })->namespace('Admin\User');

    Route::prefix('users/managment')->group(function () {

        Route::resource('admin', AdminController::class, ['as' => 'admin','except' => 'edit']);
        Route::resource('role', RoleController::class, ['as' => 'admin','except' => 'edit']);

    })->namespace('Admin\User');


});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/phpinfo', function () {
    return phpinfo();
});
