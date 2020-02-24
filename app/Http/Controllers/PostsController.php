<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Topic;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostsRequest;

class PostsController extends Controller
{
    public function store(PostsRequest $request, Topic $topic)
    {
        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->posts()->save($post);

        return new PostResource($post);
    }

    public function show(Topic $topic, Post $post)
    {
        return new PostResource($post);
    }

    public function update(PostsRequest $request, Topic $topic, Post $post)
    {
        $this->authorize('update', $post);

        $post->body = $request->get('body', $request->body);

        $post->save();

        return new PostResource($post);
    }

    public function destroy(Topic $topic, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response(null, 201);
    }
}