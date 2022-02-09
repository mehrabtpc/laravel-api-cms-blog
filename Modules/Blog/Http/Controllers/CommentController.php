<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Http\Requests\Comment\StoreCommentRequest;
use Modules\Blog\Http\Requests\Comment\UpdateCommentRequest;
use Modules\Blog\Http\Requests;

class CommentController extends Controller
{
    public function index()
    {
        $comment=Comment::query()->get();
        return response()->success('', compact('comment'));
    }

    public function store(StoreCommentRequest $request)
    {
        $comment=Comment::create([
            'body' => $request->body,
            'user_id' => auth()->user->id,
            'post_id' =>$request->post_id,
        ]);
        return response()->success('', compact('comment'));

    }

    public function show(Comment $comment)
    {
        return response()->success('', compact('comment'));

    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update([
           'body' => $request->body,
           'user_id' => auth()->user->id,
           'post_id' =>$request->post_id,
        ]);
        return response()->success('', compact('comment'));
    }

    public function destroy(Comment $comment)
    {
        $comment->destroy();
        return response()->success('', compact('comment'));

    }
}
