<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Market\Brand;
use App\Models\Tag;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.market.Brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.market.Brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ImageService $imageService)
    {

        $images = [];
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images/brands');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()->route('market.brand.index');
            }
            $images = $request->images = $result;

        }


        $brand = Brand::create([
            'name' => $request->name,
            'persian_name' => $request->persian_name,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $images
        ]);

        $tagNames = explode(",", $request->input('tags')[0]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $brand->tags()->attach($tagIds);

        return redirect()->route('market.brand.index')
            ->with('success', 'Brand Succesfull created.');


    }


    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('layouts.admin.market.Brand.show', ['brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand, ImageService $imageService)
    {

        $images = $brand->image;

        if ($request->hasFile('image')) {
            if (!empty($brand->image)) {
                $imageService->deleteDirectoryAndFiles($brand->image['directory']);
            }

            $imageService->setExclusiveDirectory('images/brands');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('market.brand.index');
            }
            $images = $request->images = $result;
        } elseif ($request->has('currentImage') && $brand->image) {
            $images = $request->images = array_merge($brand->image, [
                'currentImage' => $request->input('currentImage')
            ]);
        }


        \Log::debug('image', [$request->name]);
        $brand->update([
            'name' => $request->name,
            'persian_name' => $request->persian_name,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $images
        ]);


        $tagNames = explode(',', $request->input('tags')[0]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::updateOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $brand->tags()->sync($tagIds);

        return redirect()->route('market.brand.index')
            ->with('success', 'Brand updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand, ImageService $imageService)
    {

        $imageService->deleteDirectoryAndFiles($brand->image['directory']);
        $brand->delete();


        return redirect()->route('market.brand.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
