<?php

namespace App\Http\Livewire\TeamMember;

use App\Models\TeamMember as ModelName;
use App\Traits\WithCheckbox;
use App\Traits\WithSorting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Termwind\Components\Dd;
use WireUi\Traits\Actions;

class TeamMember extends Component
{
    use WithPagination, WithFileUploads, Actions, WithCheckbox, WithSorting, AuthorizesRequests;

    public $name, $position, $github, $twitter, $linkedin, $photo;

    public $model;
    public $openModelTeam = false;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'asc', 'as' => 'dir'],
    ];

    protected $rules = [
        'name' => 'required',
        'position' => 'required',
        'photo' => 'required|image|max:2048',
        'github' => 'nullable|url',
        'twitter' => 'nullable|url',
        'linkedin' => 'nullable|url',
    ];

    public function mount()
    {
        $this->model = new ModelName();
        $this->model_id = $this->model->id;
    }

    public function store()
    {
        $this->validate();

        $this->model::create([
            'name' => $this->name,
            'position' => $this->position,
            'github' => $this->github,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
        ])
            ->addMedia($this->photo->getRealPath())
            ->usingName($this->photo->getClientOriginalName());

        $this->close();
        $this->notification()->success('Success', __('Team member created successfully.'));
        $this->reset(['name', 'position', 'github', 'twitter', 'linkedin', 'photo']);
    }

    public function delete(int $id)
    {
        $this->authorize('team_delete');

        $team = $this->model->findOrFail($id);
        $team->delete();
        $this->notification()->success('Successfully', "Team {$team->name} has been deleted");
    }

    public function edit(int $id)
    {
        $this->open();
        $this->model_id = $id;
        $edit = $this->model->findOrFail($id);

        $this->name = $edit->name;
        $this->position = $edit->position;
        $this->github = $edit->github;
        $this->twitter = $edit->twitter;
        $this->linkedin = $edit->linkedin;
    }

    public function update()
    {
        $this->model->findOrFail($this->model_id)->update([
            'name' => $this->name,
            'position' => $this->position,
            'github' => $this->github,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
        ]);
        $this->close();
        $this->resetAttributes();
    }

    public function close()
    {
        $this->openModelName = false;
    }

    public function open()
    {
        $this->openModelTeam = true;
    }

    public function openModel(){
        $this->openModelTeam = true;
    }

    public function resetAttributes()
    {
        $this->reset(['id', 'name', 'position', 'github', 'twitter', 'linkedin', 'created_at', 'updated_at']);
    }

    public function updated()
    {
        $this->setModel('App\\Models\\TeamMember', 'name');
    }

    public function render()
    {
        $staffs = $this->model
            ::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);
        return view('livewire.teammember.teammember', compact('staffs'));
    }
}
