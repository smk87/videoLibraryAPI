<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title', 'url', 'description', 'thumbnailUrl', 'like_id', 'comment_id',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class); // Likes on the video
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); // Comments on the video
    }
}