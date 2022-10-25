<?php

namespace App\Traits\Comments;

trait HasComments

{
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function replys()
    {
        return $this->hasMany('App\Models\Reply');
    }
}
