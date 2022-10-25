<?php

namespace App\Http\Livewire\Profile;

use App\Http\Livewire\User\User;
use Livewire\Component;

class Privacy extends Component
{

    public $profile_privacy;

    // public function mount(User $user)
    // {
    //     $this->model = $user;
    //     $this->profile_privacy = $user->profile_privacy;
    // }

    public function updatePrivacy()
    {
        $this->validate([
            'profile_privacy' => 'required|in:0,1',
        ]);

        auth()->user()
            ->update([
                'is_public' => $this->profile_privacy,
            ]);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.profile.privacy');
    }
}
