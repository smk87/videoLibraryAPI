<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'video_id', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // The user who commented
    }

    public function video()
    {
        return $this->belongsTo(Video::class); // The video which is commented
    }
}