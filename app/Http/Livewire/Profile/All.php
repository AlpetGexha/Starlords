<?php

namespace App\Http\Livewire\Profile;

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class All extends Component
{
    use WithPagination;

    public $eventOnly = false;
    public $withActiceEvent = false;

    public $search;
    public $orderBy = 'id';
    public $order = 'desc';

    public $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'orderBy' => ['except' => 'id'],
        'order' => ['except' => 'desc'],
    ];

    public function orderBy($colum, $order)
    {
        $this->orderBy = $colum;
        $this->order = $order;
    }

    public function clearAll()
    {
        $this->reset();
        $this->resetPage();
    }

    public function render()
    {
        $proifiles = Profile::query()
            ->when($this->eventOnly, function ($query) {
                $query->whereHas('events');
            })
            ->when($this->withActiceEvent, function ($query) {
                $query->whereHas('events', function ($query) {
                    $query->where('end_date', '>=', now());
                });
            })
            ->where('name', 'like', '%' . $this->search . '%')
            ->with(['user:id,name,username', 'media'])
            ->paginate(15);

        return view('livewire.profile.all', compact('proifiles'));
    }
}
