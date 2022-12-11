<?php

namespace App\Models;

use App\Traits\Cache\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponzor extends Model
{
    use HasFactory,ClearsResponseCache;

    protected $fillable = [
        'url_image', 'url', 'name'
    ];
}
