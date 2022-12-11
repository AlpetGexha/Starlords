<?php

namespace App\Models;

use App\Traits\Cache\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Wishlist\Wishlistable;
use App\Traits\Comments\Commentable;
use App\Traits\Reports\Reported;
use Illuminate\Database\Eloquent\SoftDeletes;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Event extends Model implements CanVisit, Auditable, HasMedia
{
    use HasFactory, Wishlistable, HasTags, Commentable, SoftDeletes, Reported, HasVisits, InteractsWithMedia, ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'user_id', 'profile_id', 'title', 'slug', 'body', 'price', 'start_date', 'end_date', 'views'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function category()
    {
        return $this->belongsToMany(EventCategory::class, 'event_categorys');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('profile')
            ->useFallbackUrl(config('app.no_file'))
            ->singleFile();
    }

    protected $withCount = [
        'likes',
        'comments',
    ];

    public function isLiked(): bool
    {
        if (auth()->user()) {
            return auth()->user()->likes()->where('event_id', $this->id)->count();
        }

        if (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            return $this->likes()->forIp($ip)->forUserAgent($userAgent)->count();
        }

        return false;
    }

    public function removeLike(): bool
    {
        if (auth()->user()) {
            return auth()->user()->likes()->where('event_id', $this->id)->delete();
        }

        if (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            return $this->likes()->forIp($ip)->forUserAgent($userAgent)->delete();
        }

        return false;
    }

    protected static function booted()
    {
        // We will automatically add the user to the post when it's saved.
        static::creating(function ($event) {
            if (auth()->user()) {
                $event->user_id = auth()->id();
            }
        });

        static::created(function ($event) {

            $event->slug = $event->createSlug($event->title);

            $event->save();
        });
    }

    public function getImage()
    {
        return $this->getMedia('profile')->first() ? $this->getMedia('profile')->first()->getUrl() : config('app.no_file_event');
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
