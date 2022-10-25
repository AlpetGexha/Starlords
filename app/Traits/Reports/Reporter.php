<?php

namespace App\Traits\Reports;

trait Reporter
{
    public function report()
    {
        return $this->hasMany(Report::class, 'reportable');
    }
}
