<?php

namespace App\Http\Livewire\Event;

use App\Models\EventCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;

class Search extends Component
{
    public $categorys = [];
    public $search;
    public $category = [];

    public function loadCategory()
    {
        $this->categorys = Cache::remember('search-category', 60 * 60 * 6, function () {
            return EventCategory::getCategory();
        });
    }

    public function search()
    {
        // method whitout using routes direct
        $string = '?q=' . $this->search;
        $i = 0;
        foreach ($this->category as $c) {
            $string .= "&category[{$i}]={$c}";
            $i++;
        }
        // $string = Str::substr($string, 0, -1);
        return to_route('event.show', ['search' => $string]);
    }

    public function render()
    {
        $categorys = EventCategory::orderBy('id', 'desc')->get();
        return view('livewire.event.search');
    }
}
