<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;

use Spatie\MediaLibrary\InteractsWithMedia;

class Album extends Model implements HasMedia, CanVisit
{
    use HasFactory, InteractsWithMedia, HasVisits;

    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // media collection
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('album');
    }

    public function getImage()
    {
        return $this->getFirstMediaUrl('album');
    }
}
