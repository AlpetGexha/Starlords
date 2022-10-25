<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use App\Models\EventCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{

    use WithPagination;

    public $perPage = 16;
    public $category = [];
    public $maxPrice = 300;
    public $minPrice = 1;

    public $search;
    public $date;
    public $orderBy = 'id';
    public $order = 'desc';
    public $organization ;

    public $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
        'orderBy' => ['except' => 'id'],
        'order' => ['except' => 'desc'],
        'maxPrice' => ['except' => 300, 'as' => 'max'],
        'minPrice' => ['except' => 1, 'as' => 'min'],
        'category' => ['except' => '', 'as' => 'category'],
        'organization' => ['except' => '', 'as' => 'organization'],
    ];


    public function loadMore()
    {
        $this->perPage += 15;
    }

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
        // dd($this->category);
        $events = Event::query()
            ->with(['user:id,name,username', 'category', 'media'])
            ->where('start_date', '>=', now())
            ->where('title', 'like', '%' . $this->search . '%')
            ->where('body', 'like', '%' . $this->search . '%')
            ->join('event_categorys', 'event_categorys.event_id', '=', 'events.id')
            ->when($this->category, function ($query) {
                return $query->whereIn('event_categorys.event_category_id', $this->category);
            })
            ->when($this->maxPrice, function ($query) {
                return $query->where('price', '<=', $this->maxPrice);
            })
            ->when($this->minPrice, function ($query) {
                return $query->where('price', '>=', $this->minPrice);
            })
            ->when($this->organization, function ($query) {
                return $query->whereHas('profile', function ($query) {
                    $query->where('slug', $this->organization);
                });
            })
            ->orderBy($this->orderBy, $this->order)
            ->fastPaginate($this->perPage);
        $categories = EventCategory::select('id', 'title', 'slug')->get();
        return view('livewire.event.show', compact('events', 'categories'));
    }
}
