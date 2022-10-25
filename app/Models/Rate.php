<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Rates\Rating;
use OwenIt\Auditing\Contracts\Auditable;

class Rate extends Model implements Auditable
{
    use HasFactory, Rating;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    protected $table = 'ratable';
}
