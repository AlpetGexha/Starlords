<?php

namespace App\Http\Livewire\Category;

use App\Models\EventCategory;
use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        $categorys = EventCategory::with('media')
            ->orderBy('id', 'desc')
            ->get();
        return view('livewire.category.show', compact('categorys'));
    }
}
