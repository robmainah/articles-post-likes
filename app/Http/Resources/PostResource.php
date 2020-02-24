<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'body' => $this->body,
            'updated_at' => $this->updated_at->diffForHumans(),
            'user' => new UserResource($this->user),
            'likes_count' => $this->likes->count(),
            'users' => UserResource::collection($this->likes->pluck('user'))
        ];
    }
}