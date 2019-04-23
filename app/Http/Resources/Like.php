<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Like extends JsonResource
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
            'like' => ($this->like ? true : false)
        ];
    }
}