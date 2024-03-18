<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Market\ProductCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('layouts.admin.market.Category.index');
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('layouts.admin.market.Category.create', ['categories' => $categories]);
    }


    public function show(ProductCategory $category)
    {
        $categories = ProductCategory::all()->except($category->id);

        return view('layouts.admin.market.Category.show',
            [
                'category' => $category,
                'categories' => $categories
            ]

        );
    }

    public function store(Request $request, ImageService $imageService)
    {
        $productCategory = new ProductCategory();


        $images = [];
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images/product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()->route('content.category.index');
            }
            $images = $request->images = $result;

        }


        $productCategory->name = $request->name;
        $productCategory->status = $request->status;
        $productCategory->description = $request->description;
        $productCategory->parent_id = $request->parent_id;
        $productCategory->show_in_menu = $request->show_in_menu;
        $productCategory->image = $images;


        if ($request->input('parent_id')) {
            $parent = ProductCategory::find($request->input('parent_id'));
            $parent->addChild($productCategory);
        } else {
            $productCategory->save();
        }


        $tagNames = explode(",", $request->input('tags')[0]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $productCategory->tags()->attach($tagIds);

        return redirect()->route('market.category.index')
            ->with('success', 'Category Succesfull created.');
    }

    public function update(Request $request, ProductCategory $category, ImageService $imageService)
    {
      //  $mCategory = $productCategory;
        $images = $category->image;

        if ($request->hasFile('image')) {
            if (!empty($category->image)) {
                $imageService->deleteDirectoryAndFiles($category->image['directory']);
            }
            $imageService->setExclusiveDirectory('images/product-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('content.category.index');
            }
            $images = $request->images = $result;
        } elseif ($request->has('currentImage') && $category->image) {
            $images = $request->images = array_merge($category->image, [
                'currentImage' => $request->input('currentImage')
            ]);
        }

        $category->update([
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'show_in_menu' => $request->show_in_menu,
            'image' => $images,
        ]);

       if ($request->input('parent_id')) {
            $parent = ProductCategory::find($request->input('parent_id'));
            $parent->addChild($category);
        } else {
           $category->save();
        }



        $tagNames = explode(',', $request->input('tags')[0]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::updateOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $category->tags()->sync($tagIds);



        return redirect()->route('market.category.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(ProductCategory $category,ImageService $imageService)
    {
        $imageService->deleteDirectoryAndFiles($category->image['directory']);
        $category->delete();
        return redirect()->route('market.category.index')
            ->with('success', 'Product category deleted successfully.');
    }

}
