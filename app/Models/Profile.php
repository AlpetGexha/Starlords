<?php

namespace App\Models;

use App\Traits\Reports\Reported;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use App\Traits\Rates\Rateable;
use Illuminate\Support\Str;
use Overtrue\LaravelSubscribe\Traits\Subscribable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;
use OwenIt\Auditing\Contracts\Auditable;

class Profile extends Model implements CanVisit, HasMedia, Auditable
{
    use HasFactory, InteractsWithMedia, HasTags, Reported, Rateable, HasVisits, Subscribable;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id', 'profile_id', 'name', 'slug', 'body', 'email', 'category', 'location', 'phone', 'facebook', 'twitter', 'instagram', 'linkedin', 'website', 'link', 'is_active', 'is_verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // media collection
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('event')
            ->useFallbackUrl(config('app.no_file'))
            ->singleFile();
    }

    //  public function registerMediaConversions(Media $media = null): void
    //  {
    //      $this
    //          ->addMediaConversion('thumb')
    //          ->width(415)
    //          ->height(220);
    //  }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($profile) {
            $profile->slug = $profile->createSlug($profile->name);
            $profile->save();
        });

        if (auth()->check()) {
            static::creating(function ($profile) {
                $profile->user_id = auth()->id();
            });
        }
    }

    private function createSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {

            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');

            if (isset($max[-1]) && is_numeric($max[-1])) {

                return preg_replace_callback('/(\d+)$/', function ($mathces) {

                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    protected $casts = [
        'category' => 'array',
    ];


    public function getImage()
    {
        return $this->getFirstMediaUrl('event');
    }

    public function scopeHasTickets($query)
    {
        $query->whereHas('tickets', function ($q) {
            $q->where('user_id', auth()->id());
        });
    }
}
