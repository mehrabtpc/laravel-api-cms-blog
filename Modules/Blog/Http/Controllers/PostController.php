<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\Post\StorePostRequest;
use Modules\Blog\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller
{

    public function index()
    {
        $post=Post::query()->get();
        return response()->success('', compact('post'));
    }

    public function store(StorePostRequest $request)
    {
        //store post
        $post=Post::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'user_id' => auth()->user->id,
            //image->spatie media
            //category ->many to many relationship
            //tag ->spatie tag
        ]);

        //add image
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $post->addMediaFromRequest('image')->toMediaCollection('files');
        }
        //add tags
        $tags = explode(",", $request->tags);
        $post->attachTags([$tags]);

        //return data
        return response()->success('', compact('post'));
    }

    public function show(Post $post)
    {
        return response()->success('', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //update post
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'user_id' => auth()->user->id,
            //image->spatie media
            //category ->many to many relationship
            //tag ->spatie tag
        ]);

        //update images
        if ($request->hasFile('image')) {
            $post->media()->delete();
            $post->addMedia('image')->toMediaCollection('files');
        }

        //update tags
        $tags = explode(",", $request->tags);
        $post->syncTags([$tags]);

        //return date
        return response()->success('', compact('post'));
    }

    public function destroy(Post $post)
    {
        $post->destroy();
        //delete image
        if($post->hasFile('image') && $post->file('image')->isValid()) {
            $post->media()->delete();
        }

        return response()->success('', compact('post'));
    }
}
