<?php

namespace App\Models;

use App\Traits\Cache\ClearsResponseCache;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Tags\HasTags;

class Blog extends Model implements HasMedia, CanVisit, Auditable
{
    use HasFactory, InteractsWithMedia, HasVisits, HasTags, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'title', 'slug', 'body', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // media collection
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('blog')
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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($blog) {

            $blog->slug = $blog->createSlug($blog->title);

            $blog->save();
        });

        if (auth()->check()) {
            static::creating(function ($blog) {
                $blog->user_id = auth()->id();
            });
        }
    }

    private function createSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {

            $max = static::whereTitle($name)->latest('id')->skip(1)->value('slug');

            if (isset($max[-1]) && is_numeric($max[-1])) {

                return preg_replace_callback('/(\d+)$/', function ($mathces) {

                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}
