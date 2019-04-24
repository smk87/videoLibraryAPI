<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
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
            'user' => ['id' => $this->user->id, 'name' => $this->user->name, "photoUrl" => $this->user->photoUrl, 'email' => $this->user->email],
            'comment' => $this->comment,
            'timestamp' => (string)$this->created_at
        ];
    }
}