<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Content\Post;
use App\Models\Admin\Content\PostCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {

        return view('layouts.admin.content.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postCategory = PostCategory::all();
        return view('layouts.admin.content.post.create', [
            'categories' => $postCategory
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ImageService $imageService)
    {
        $post = new Post();

        $images = [];
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images/post');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if ($result === false) {
                return redirect()->route('content.category.index');
            }
            $images = $request->images = $result;

        }


        $post->title = $request->title;
        $post->status = $request->status;
        $post->is_comment = $request->is_comment;
        $post->body = $request->description;
        $post->category_id = $request->category_id;
        $post->image = $images;

        $post->published_at = '2022-05-10 15:42:39';
        $post->summery = 'summery';
        $post->user_id = 1;
        $post->save();


        $tagNames = explode(",", $request->input('tags')[0]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $post->tags()->attach($tagIds);

        return redirect()->route('content.post.index')
            ->with('success', 'Post Succesfull created.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $postCategory = PostCategory::all();
        //   dd($post->tags()->pluck('name')->toArray());
        return view('layouts.admin.content.post.show', [
                'post' => $post,
                'categories' => $postCategory
            ]
        );
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
    public function update(Request $request, Post $post, ImageService $imageService)
    {

        $images = $post->image;

        if ($request->hasFile('image')) {
            if (!empty($post->image)) {
                $imageService->deleteDirectoryAndFiles($post->image['directory']);
            }
            $imageService->setExclusiveDirectory('images/post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('content.category.index');
            }
            $images = $request->images = $result;
        } elseif ($request->has('currentImage') && $post->image) {
            $images = $request->images = array_merge($post->image, [
                'currentImage' => $request->input('currentImage')
            ]);
        }

        $post->update([
            'title' => $request->title,
            'status' => $request->status,
            'is_comment' => $request->is_comment,
            'category_id' => $request->category_id,
            'body' => $request->description,
            'image' => $images,
            'published_at' => '2022-05-10 15:42:39',
            'summery' => 'updated summery',
            'user_id' => 1,

        ]);

        $tagNames = explode(',', $request->input('tags')[0]);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::updateOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $post->tags()->sync($tagIds);

        return redirect()->route('content.post.index')
            ->with('success', 'Post updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post,ImageService $imageService)
    {

        $post->delete();
        $imageService->deleteDirectoryAndFiles($post->image['directory']);
        return redirect()->route('content.post.index')
            ->with('success', 'Post deleted successfully.');
    }
}
