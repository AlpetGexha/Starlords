<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Wishlist\HasWishlists;
use App\Traits\Comments\HasComments;
use App\Traits\Reports\Reporter;
use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Support\Facades\Cache;
use Overtrue\LaravelSubscribe\Traits\Subscriber;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;


class User extends Authenticatable implements CanVisit, Auditable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasWishlists, HasComments, HasVisits, HasRoles, Reporter, Subscriber, AuthenticationLoggable;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name', 'email', 'password', 'username', 'banned_till', 'banend_reason', 'provider', 'provider_id', 'profile_photo_path', 'is_verified', 'is_public'
    ];

    protected $hidden = [
        'password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function username()
    {
        return $this->username ? $this->username : $this->name;
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getBanData()
    {
        $message = "";
        if ($this->banned_till) {
            $message = "Banned till: " . $this->banned_till . "\n";
        }

        if ($this->banned_till == 0) {
            $message = "Permanent Ban";
        }

        if ($this->banend_reason) {
            $message .= "Becuase: " . $this->banend_reason;
        }

        return $message;
    }

    public function getActivity(): bool
    {
        return Cache::has('user-is-online-' . $this->id) ? false : true;
    }

    public function isVerified(): bool
    {
        return $this->is_verified;
    }

    public function avatar()
    {
        return $this->profile_photo_path ? $this->profile_photo_path : $this->profile_photo_url;
    }

    // make attribute for avatar
    public function getAvatarAttribute()
    {
        return $this->avatar();
    }

    public function hasProfile()
    {
        return $this->profile()->exists();
    }

    public function hasEvent()
    {
        return $this->events()->exists();
    }

    public function isPublic()
    {
        return $this->is_public;
    }
}
