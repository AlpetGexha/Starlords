<?php

namespace App\Traits\Reports;

use App\Models\Report;

trait Reported
{
    public function report()
    {
        return $this->morphMany('App\Models\Report', 'reportable');
    }

    public function storeReport($body)
    {
        if ($this->report()->where('user_id', auth()->id())->exists()) {
            session()->flash('error', 'You have already reported this profile');
            return;
        }

        if ($this->report()->where('ip', request()->ip())->exists()) {
            session()->flash('error', 'You have already reported this profile');
            return;
        }

        if (auth()->check()) {
            $this->report()->create([
                'user_id' => auth()->user()->id,
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'reason' => $body,
            ]);
        } else {
            $this->report()->create([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'reason' => $body,
            ]);
        }
    }
}
