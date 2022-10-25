<?php

namespace App\Http\Livewire\EventCategory;

use App\Models\EventCategory as ModelName;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSorting;
use App\Traits\WithCheckbox;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class EventCategory extends Component
{
    use WithPagination, WithFileUploads, Actions, WithCheckbox, WithSorting, AuthorizesRequests;

    public $title, $body, $slug, $photo;

    public $model;
    public $openModelName = false;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'desc', 'as' => 'dir'],
    ];

    protected $rules = [
        'title' => 'required',
        'body' => 'required',
        'slug' => 'required',
        'photo' => 'required|image',
    ];

    public function mount()
    {
        $this->model = new ModelName();
        $this->model_id = $this->model->id;
    }

    public function store()
    {
        $this->authorize('category_access');
        $this->validate();

        $this->model::create([
            'title' => $this->title,
            'body' => $this->body,
            'slug' => Str::slug($this->title)
        ])
            ->addMedia($this->photo->getRealPath())
            ->usingName($this->photo->getClientOriginalName());

        $this->close();
        $this->notification()->success('Success', __('Event category created successfully.'));
        $this->reset(['title', 'body', 'slug', 'photo']);
    }

    public function delete(int $id)
    {
        $this->authorize('category_delete');
        $this->model->findOrFail($id)->delete();
        $this->notification()->success('Success', 'Deleted Successfully');
    }

    public function edit(int $id)
    {
        $this->open();
        $this->model_id = $id;
        $edit = ModelName::findOrFail($id);

        $this->title = $edit->title;
        $this->body = $edit->body;
        $this->slug = $edit->slug;
    }

    public function update()
    {
        $this->authorize('category_edit');
        ModelName::findOrFail($this->model_id)->update([
            'title' => $this->title,
            'body' => $this->body,
            'slug' => $this->slug,
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
        $this->openModelName = true;
    }

    public function resetAttributes()
    {
        $this->reset(['id', 'title', 'body', 'slug', 'created_at', 'updated_at']);
    }

    public function updated()
    {
        $this->setModel('App\\Models\\EventCategory', 'title');
    }

    public function render()
    {
        $categorys = $this->model
            ::where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);
        return view('livewire.eventcategory.eventcategory', compact('categorys'));
    }
}
