<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Post;
use App\Http\Resources\TopicResource;
use App\Http\Requests\TopicsRequest;
// use App\Policies\TopicPolicy;

class TopicsController extends Controller
{

    public function index()
    {
        $topic = Topic::latestFirst()->paginate(4);

        return TopicResource::collection($topic);
    }

    public function store(TopicsRequest $request)
    {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->user()->associate($request->user());

        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->save();
        $topic->posts()->save($post);

        return new TopicResource($topic);
    }

    public function show(Topic $topic)
    {
        return new TopicResource($topic);
    }

    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $topic->title = $request->get('title', $request->title);

        $topic->save();

        return new TopicResource($topic);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        return response(null, 201);
    }
}