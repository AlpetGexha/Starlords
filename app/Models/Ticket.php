<?php

namespace App\Models;

use App\Traits\Uuid\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, HasUUID;

    protected $fillable = [
        'user_id', 'event_id', 'profile_id', 'date_expire', 'refund_date_expire', 'status', 'stripe_id', 'stripe_token', 'uuid', 'quantity', 'price', 'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
