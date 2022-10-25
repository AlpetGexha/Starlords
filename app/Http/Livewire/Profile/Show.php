<?php

namespace App\Http\Livewire\Profile;

use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public $user_id;

    public function mount(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function render()
    {
        $profiles = Profile::where('user_id', $this->user_id)
            ->get();
        return view('livewire.profile.show', compact('profiles'));
    }
}
