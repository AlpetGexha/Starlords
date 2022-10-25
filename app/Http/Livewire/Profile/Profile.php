<?php

namespace App\Http\Livewire\Profile;

use App\Models\Profile as ModelName;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSorting;
use App\Traits\WithCheckbox;
use WireUi\Traits\Actions;

class Profile extends Component
{
    use WithPagination, Actions, WithCheckbox, WithSorting;

    public $user_id, $name, $slug, $body, $email, $phone, $category, $facebook, $twitter, $instagram, $linkedin, $website, $link, $location, $address, $is_active, $is_verified;

    public $model;
    public $openModelName = false;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'asc', 'as' => 'dir'],
    ];

    public function mount()
    {
        $this->model = new ModelName();
        $this->model_id = $this->model->id;
    }

    public function delete(int $id)
    {
        $this->model->findOrFail($id)->delete();
        $this->notification()->success('Success','Deleted Successfully');
    }

    public function updated()
    {
        $this->setModel('App\\Models\\Profile', 'name');
    }

    public function render()
    {
        $all = $this->model
            ::where('name', 'like', '%' . $this->search . '%')
            ->with('user',)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);
        return view('livewire.profile.profile', compact('all'));
    }
}
