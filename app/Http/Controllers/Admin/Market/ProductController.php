<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Content\PostCategory;
use App\Models\Admin\Market\Brand;
use App\Models\Admin\Market\Color;
use App\Models\Admin\Market\Product;
use App\Models\Admin\Market\ProductCategory;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        Session::put('product_url',\request()->fullUrl());
        return view('layouts.admin.market.Product.index');
    }

    public function galleryIndex(Product $product)
    {
        return view('layouts.admin.market.Product.Gallery.index', compact('product'));
    }


    public function colorIndex(Product $product)
    {
        return view('layouts.admin.market.Product.Color.index', compact('product'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        $productColors = Color::all();
        $brands = Brand::all();
        return view('layouts.admin.market.Product.create',
            [
                'brands' => $brands,
                'colors' => $productColors,
                'categories' => $productCategories
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ImageService $imageService)
    {
        try {
            DB::beginTransaction();
            $product = new Product();

            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images/products');
                $result = $imageService->createIndexAndSave($request->file('image'));

                if ($result === false) {
                    return redirect()->route('market.product.index');
                }
                $images = $request->images = $result;
            }

            $productData = [
                'name' => $request->name,
                'model_name' => $request->model_name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'status' => $request->status,
                'marketable' => $request->marketable,
                'introduction' => $request->introduction,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'published_at' => '2022-05-10 15:42:39',
                'image' => $images,
            ];

            $product->fill($productData);
            $product->save();


            $tagNames = explode(",", $request->input('tags')[0]);
            $tagIds = Tag::whereIn('name', $tagNames)->pluck('id')->toArray();
            $product->tags()->attach($tagIds);


            DB::commit();

            return redirect()->route('market.product.index')
                ->with('success', 'Product successfully created.');
        } catch (\Exception $e) {
            DB::rollback();

            \Log::error($e->getMessage());
            return redirect()->route('market.product.index')
                ->with('error', 'Failed to create the product.');
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        $productColors = Color::all();
        return view('layouts.admin.market.Product.show',
            ['product' => $product,
                'brands' => $brands,
                'colors' => $productColors,
                'categories' => $productCategories
            ]
        );

    }


    public function update(Request $request, Product $product, ImageService $imageService)
    {


        try {
            DB::beginTransaction();


            if ($request->hasFile('image')) {
               /* if (!empty($product->image) && is_array($product->image)) {
                    $imageService->deleteDirectoryAndFiles($product->image['directory']);
                }*/

                $imageService->setExclusiveDirectory('images/products');
                $result = $imageService->createIndexAndSave($request->file('image'));

                if ($result === false) {
                    return redirect()->route('market.product.index');
                }

                $product->image = $result;
            }


            $product->update([
                'name' => $request->name,
                'model_name' => $request->model_name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'status' => $request->status,
                'marketable' => $request->marketable,
                'introduction' => $request->introduction,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                //'default_color_id' => $request->default_color_id,
                'published_at' => '2022-05-10 15:42:39',
            ]);

            $tagNames = explode(',', $request->input('tags')[0]);
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::updateOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $product->tags()->sync($tagIds);

            DB::commit();

            if (\session('product_url')){
                return redirect(\session('product_url'))
                    ->with('success', 'Product successfully updated.');
            }

            return redirect()->route('market.product.index');

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            DB::rollback();
            return redirect()->route('market.product.index')
                ->with('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ImageService $imageService)
    {
        $imageService->deleteDirectoryAndFiles($product->image['directory']);
        $product->delete();
        return redirect()->route('market.product.index')
            ->with('success', 'Product deleted successfully.');

    }
}
