<?php

namespace App\Http\Livewire\Album;

use Livewire\Component;

class Show extends Component
{

    public $profile_id;

    public function mount(int $profile_id)
    {
        $this->profile_id = $profile_id;
    }

    public function render()
    {
        
        return view('livewire.album.show');
    }
}
