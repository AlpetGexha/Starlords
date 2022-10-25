<?php

namespace App\Http\Livewire\Sponzor;

use App\Models\Sponzor as ModelName;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSorting;
use App\Traits\WithCheckbox;
use WireUi\Traits\Actions;

class Sponzor extends Component
{
    use WithPagination, Actions, WithCheckbox, WithSorting;

    public $url_image, $name, $url;

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
        $this->notification()->success('Success', 'Deleted Successfully');
    }

    public function updated()
    {
        $this->setModel('App\\Models\\Sponzor', 'name');
    }

    public function render()
    {
        $all = $this->model
            ::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);
        return view('livewire.sponzor.sponzor', compact('all'));
    }
}
