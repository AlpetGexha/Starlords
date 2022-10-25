<?php

namespace App\Traits\Wishlist;

use App\Models\User;
use Auth;
use DB;

trait Wishlistable
{
    /**
     * Get all of the wishes for the model.
     */
    public function wishes()
    {
        return $this->morphToMany(User::class, 'model', 'wishlist');
    }

    /**
     * isWished.
     */
    public function isWished(): bool
    {
        return $this->wishes()->where('user_id', Auth::id())->exists();
    }
}
