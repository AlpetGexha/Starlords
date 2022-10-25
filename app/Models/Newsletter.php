<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelSubscribe\Traits\Subscriber;

class Newsletter extends Model
{
    use HasFactory, Subscriber;

    protected $fillable = ['email', 'is_subscribed', 'token'];
}
