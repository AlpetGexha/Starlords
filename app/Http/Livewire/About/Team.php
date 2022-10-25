<?php

namespace App\Http\Livewire\About;

use App\Models\TeamMember;
use App\Settings\AboutUsSettings;
use Livewire\Component;

class Team extends Component
{

    public function render(AboutUsSettings $setting)
    {
        $teams = TeamMember::with('media')->select('name', 'position', 'twitter', 'linkedin', 'github')->get();
        return view('livewire.about.team', compact('teams', 'setting'));
    }
}
