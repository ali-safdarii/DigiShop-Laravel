<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Content\PostCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use function redirect;
use function view;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {

        return view('layouts.admin.content.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCategoryRequest $request, ImageService $imageService)
    {

        $postCategory = new PostCategory();
        $images = [];
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()->route('content.postCategory.index');
            }
            $images = $request->images = $result;

        }


        $postCategory->name = $request->name;
        $postCategory->status = $request->status;
        $postCategory->description = $request->description;
        $postCategory->image = $images;
        $postCategory->save();



        $tagNames = explode(",", $request->input('tags')[0]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $postCategory->tags()->attach($tagIds);

        return redirect()->route('content.postCategory.index')
            ->with('success', 'Category Succesfull created.');


    }


    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory)
    {

        return view('layouts.admin.content.category.show',
            [
                'postCategory' => $postCategory,

            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostCategory $postCategory, ImageService $imageService)
    {

        $images = $postCategory->image;

        if ($request->hasFile('image')) {
            if (!empty($postCategory->image)) {
                $imageService->deleteDirectoryAndFiles($postCategory->image['directory']);
            }
            $imageService->setExclusiveDirectory('images/post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('content.postCategory.index');
            }
            $images = $request->images = $result;
        } elseif ($request->has('currentImage') && $postCategory->image) {
            $images = $request->images = array_merge($postCategory->image, [
                'currentImage' => $request->input('currentImage')
            ]);
        }

        $postCategory->update([
            'name' => $request->name,
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
        $postCategory->tags()->sync($tagIds);

        return redirect()->route('content.postCategory.index')
            ->with('success', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory,ImageService $imageService)
    {
        $postCategory->delete();
        $imageService->deleteDirectoryAndFiles($postCategory->image['directory']);
        return redirect()->route('content.postCategory.index')
            ->with('success', 'Post category deleted successfully.');
    }
}
