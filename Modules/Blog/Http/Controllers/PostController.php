<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\Post\StorePostRequest;
use Modules\Blog\Http\Requests\Post\UpdatePostRequest;
use Spatie\Tags\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::query()->get();
        return response()->json([
            'status' => 'success',
            'posts' => $posts,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $post=Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'user_id' => auth()->user()->id
            //image->spatie media
            //category ->many to many relationship
            //tag ->spatie tag
        ]);

        //add image
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $post->addMediaFromRequest('image')->toMediaCollection('files');
        }

        //add tags
        $tags =$request->tags;
        foreach ($tags as $tag){
            $tag=Tag::findOrCreate($tag);
            $post->attachTags([$tag]);
        }

        //return data
        return response()->json([
            'status' => 'success',
            'post' => $post,
            'tags' => $tags
        ]);
    }

    public function show(Post $post)
    {
        //return data
        return response()->json([
            'status' => 'success',
            'post' => $post,
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //update post
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'user_id' => auth()->user()->id,
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
//        $tags = explode(",", $request->tags);
        $tags=$request->tags;

        $post->syncTags([$tags]);

        //return data
        return response()->json([
            'status' => 'success',
            'post' => $post,
        ]);
    }

    public function destroy(Post $post)
    {
        //delete post
        $post->delete();

        //delete image
        if($post->hasFile('image') && $post->file('image')->isValid()) {
            $post->media()->delete();
        }

        //return data
        return response()->json([
            'status' => 'success',
            'post' => $post,
        ]);
    }
}
