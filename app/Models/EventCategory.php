<?php

namespace App\Models;

use App\Traits\Cache\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use OwenIt\Auditing\Contracts\Auditable;

class EventCategory extends Model implements HasMedia, Auditable
{
    use HasFactory, InteractsWithMedia,ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'title', 'body', 'slug',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // media collection
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('event_category')
            ->useFallbackUrl(config('app.no_file'))
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(415)
            ->height(220);
    }

    public function scopeGetCategory($query){
        return $query->orderBy('id', 'desc')->get();
    }
}
