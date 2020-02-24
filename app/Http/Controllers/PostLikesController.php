<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Topic;

class PostLikesController extends Controller
{
    public function store(Request $request, Topic $topic, Post $post)
    {
        $this->authorize('like', $post);

        if ($request->user()->hasLikedPost($post)) {
            return response(null, 409);
        }

        $like = new Like;
        $like->user()->associate($request->user());
        $post->likes()->save($like);

        return response(null, 204);
    }
}