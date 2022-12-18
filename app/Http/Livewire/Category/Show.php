<?php

namespace App\Http\Livewire\Category;

use App\Models\EventCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Show extends Component
{
    public $categorys = [];

    public function loadCatergory()
    {
        $this->categorys = Cache::remember('category-home', 60 * 60 * 6, function () {
            return EventCategory::with('media')->limit(12)->getCategory();
        });
    }

    public function render()
    {
        return view('livewire.category.show');
    }
}
