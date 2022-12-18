<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class IncomingEvents extends Component
{
    public $events = [];
    public function loadEvent()
    {
        $this->events = Cache::remember('event-incominc', 60 * 60 * 3, function () {
         return Event::with(['user:id,name,username', 'category', 'media'])
                ->limit(4)
                ->get();
        });
    }
    public function render()
    {
        return view('livewire.event.incoming-events');
    }
}
