<?php

namespace App\Http\Resources;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'updated_at' => $this->updated_at->diffForHumans(),
            'user' => new UserResource($this->user),
            'posts' => PostResource::collection($this->posts),
        ];
    }
}