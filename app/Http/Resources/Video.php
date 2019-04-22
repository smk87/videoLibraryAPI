<?php

namespace App\Http\Resources;

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
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'description' => $this->description,
            'thumbnailUrl' => $this->thumbnailUrl,
            'updatedTime' => ($this->updated_at > $this->created_at ? substr($this->updated_at, 0) : substr($this->created_at, 0)),
            'likes' => $this->likes,
            'comments' => $this->comments,

        ];
    }
}