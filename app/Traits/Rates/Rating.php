<?php

namespace App\Traits\Rates;

trait Rating
{
    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->belongsTo('App\Models\Comment', 'comment_id');
    }
}
