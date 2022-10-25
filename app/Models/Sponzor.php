<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponzor extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_image', 'url', 'name'
    ];
}
