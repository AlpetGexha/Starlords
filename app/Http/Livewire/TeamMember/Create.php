<?php

namespace App\Http\Livewire\TeamMember;

use App\Models\TeamMember;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Create extends Component
{
    use WithFileUploads, Actions, AuthorizesRequests;

    public $name, $position, $github, $twitter, $linkedin, $photo;

    protected $rules = [
        'name' => 'required',
        'position' => 'required',
        'photo' => 'required|image|max:2048',
        'github' => 'nullable|url',
        'twitter' => 'nullable|url',
        'linkedin' => 'nullable|url',
    ];

    public function store()
    {
        $this->authorize('team_create');
        // dd($this->photo->getRealPath());
        $this->validate();
        TeamMember::create([
            'name' => $this->name,
            'position' => $this->position,
            'github' => $this->github,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
        ])
            ->addMedia($this->photo->getRealPath())
            ->toMediaCollection('team');

        $this->notification()->success('Success', __('Team member created successfully.'));
        $this->photo = null;
        $this->reset(['name', 'position', 'github', 'twitter', 'linkedin', 'photo']);
    }


    public function render()
    {
        return view('livewire.team-member.create');
    }
}
