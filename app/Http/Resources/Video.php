<?php

namespace App\Http\Resources;

use App\Http\Resources\Like as LikeResource;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Video extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'url' => $this->url,
            'description' => $this->description,
            'thumbnailUrl' => $this->thumbnailUrl,
            'updatedTime' => ($this->updated_at > $this->created_at ? substr($this->updated_at, 0) : substr($this->created_at, 0)),
            'likes' => LikeResource::collection($this->likes), // Like resource with users reference
            'comments' => CommentResource::collection($this->comments) // Comment resource with users reference
        ];
    }
}