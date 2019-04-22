<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'like'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // The user who liked
    }

    public function video()
    {
        return $this->belongsTo(Video::class); // The video which is liked
    }
}