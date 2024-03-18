<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Content\Banner;
use Illuminate\Http\Request;
use function redirect;
use function view;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.content.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('layouts.admin.content.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ImageService $imageService)
    {
        $images = [];
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images/banners');
            $result = $imageService->save($request->file('image'));

            if ($result === false) {
                return redirect()->route('content.banners.index');
            }
            $images = $request->images = $result;

        }


        $banner = Banner::create([
            'title' => $request->title,
            'url' => $request->url,
            'position' => $request->position,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $images,
            'is_used_mobile' => $request->is_used_mobile,
        ]);


        return redirect()->route('content.banners.index')
            ->with('success', 'Banner Succesfull created.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {

        return view('layouts.admin.content.banner.show', ['banner' => $banner]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner,ImageService $imageService)
    {
        $images = $banner->image;

        if ($request->hasFile('image')) {
            if (!empty($banner->image)){
                $imageService->deleteImage($banner->image);
            }
            $imageService->setExclusiveDirectory('images/banners');
            $result = $imageService->save($request->file('image'));
            if (!$result) {
                return redirect()->route('content.banners.index');
            }
            $images = $request->images = $result;
        } elseif ($request->has('currentImage') && $banner->image) {
            $images = $request->images = array_merge($banner->image, [
                'currentImage' => $request->input('currentImage')
            ]);
        }


        $banner->update([
            'title' => $request->title,
            'url' => $request->url,
            'position' => $request->position,
            'status' => $request->status,
            'description' => $request->description,
            'is_used_mobile' => $request->is_used_mobile,
            'image' => $images,
        ]);





        return redirect()->route('content.banners.index')
            ->with('success', 'Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner,ImageService $imageService)
    {
        if (!empty($banner->image)){
            $imageService->deleteImage($banner->image);

        }
        $banner->delete();
        return redirect()->route('content.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
