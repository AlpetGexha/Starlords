<?php

namespace App\Traits\Rates;

use App\Models\Rate;
use Exception;
use Illuminate\Database\Eloquent\Model;

trait Rateable
{
    public function ratings()
    {
        return $this->morphMany('App\Models\Rate', 'rateable');
    }
    public function rate(int $rating, int $comment_id, Model $model)
    {
        if (!$rating) {
            throw new Exception('Rating is required on Rate Component');
        }

        if (!$comment_id) {
            throw new Exception('Comment is required on Rate Component');
        }

        if (!$model) {
            throw new Exception('Model not found on Rate Component');
        }
        if ($model->isRated()) {
            // throw new Exception('Already rated');
            return;
        }

        $this->createRate($rating, $comment_id, $model);
    }

    private function createRate($rating, $comment_id, $model)
    {
        $model->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $rating,
            'comment_id' => $comment_id,
            'rateable_id' => $model->id,
            'rateable_type' => get_class($model),
        ]);
    }

    public function isRated()
    {
        return $this->ratings()
            ->where('user_id', auth()->id())
            ->where('rateable_id', $this->id)
            ->where('rateable_type', get_class($this))
            ->exists();
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function sumRating()
    {
        return $this->ratings()->sum('rating');
    }

    public function timesRated()
    {
        return $this->ratings()->count();
    }

    public function usersRated()
    {
        return $this->ratings()->groupBy('user_id')->pluck('user_id')->count();
    }

    public function userAverageRating()
    {
        return $this->ratings()->where('user_id', auth()->id())->avg('rating');
    }

    public function userSumRating()
    {
        return $this->ratings()->where('user_id', auth()->id())->sum('rating');
    }

    public function specialUserAvg(int $user_id)
    {
        return $this->ratings()->where('user_id', $user_id)->avg('rating');
    }

    public function specialUserSum(int $user_id)
    {
        return $this->ratings()->where('user_id', $user_id)->sum('rating');
    }

    public function ratingPercent($max = 5)
    {
        $quantity = $this->ratings()->count();
        $total = $this->sumRating();

        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }

    // Getters

    public function getUserRate($user_id)
    {
        return Rate::where('user_id', $user_id)
            ->where('rateable_id', $this->id)
            ->where('rateable_type', get_class($this))
            ->first()
            ->rating ?? 0;
    }

    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }

    public function getSumRatingAttribute()
    {
        return $this->sumRating();
    }

    public function getUserAverageRatingAttribute()
    {
        return $this->userAverageRating();
    }

    public function getUserSumRatingAttribute()
    {
        return $this->userSumRating();
    }
}
