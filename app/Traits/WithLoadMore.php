<?php

namespace App\Traits;

trait WithLoadMore
{
    public $perPage = 10;

    public function loadMore(int $page = 10)
    {
        $this->perPage += $page;
    }

    public function loadLess(int $page = 10)
    {
        $this->perPage -= $page;
    }
}
