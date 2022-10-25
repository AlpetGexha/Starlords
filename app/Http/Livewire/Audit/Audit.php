<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;
use App\Traits\WithCheckbox;
use App\Traits\WithSorting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Audit extends Component
{
    use WithPagination, WithCheckbox, WithSorting, AuthorizesRequests;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'asc', 'as' => 'dir'],
    ];

    public function render()
    {
        $audits = DB::table('audits')->where('user_type', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate_page);
        return view('livewire.audit.audit', compact('audits'));
    }
}
