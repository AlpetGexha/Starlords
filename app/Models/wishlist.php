<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{

    use HasFactory;
    protected $guarded = [];
    protected $table = 'wishlist';
    public static function wish($model, $collectionName)
    {
        return self::create([
            'user_id' => auth()->id(),
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'collection_name' => $collectionName,
        ]);
    }
}
