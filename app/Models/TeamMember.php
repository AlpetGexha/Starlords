<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use OwenIt\Auditing\Contracts\Auditable;

class TeamMember extends Model implements HasMedia, Auditable
{
    use HasFactory, InteractsWithMedia;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name', 'position', 'github', 'twitter', 'linkedin', 'github',
    ];


    // media collection
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('team')
            ->useFallbackUrl('https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(415)
            ->height(220);
    }
}
