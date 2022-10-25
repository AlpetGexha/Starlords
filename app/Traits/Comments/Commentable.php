<?php

namespace App\Traits\Comments;

trait Commentable
{
    // array_push($this->withCount, 'comments');

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function replys()
    {
        return $this->morphMany('App\Models\Reply', 'replyable');
    }
}
