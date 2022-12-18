<?php

namespace App\Http\Livewire\About;

use App\Models\TeamMember;
use App\Settings\AboutUsSettings;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Team extends Component
{

    public $teams = [];

    public function loadTeam()
    {
        $this->teams = Cache::remember('about-team', 60 * 60 * 24, function () {
            return TeamMember::with('media')
                ->select('name', 'position', 'twitter', 'linkedin', 'github')
                ->get();
        });
    }

    public function render(AboutUsSettings $setting)
    {
        return view('livewire.about.team', compact('setting'));
    }
}
