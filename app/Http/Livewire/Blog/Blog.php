<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog as ModelName;
use App\Models\Blog as ModelsBlog;
use App\Traits\WithCheckbox;
use App\Traits\WithSorting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Blog extends Component
{
    use WithPagination, Actions, WithCheckbox, WithSorting, AuthorizesRequests;

    public $title, $slug, $body;

    public $model;
    public $openModelName = false;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'asc', 'as' => 'dir'],
    ];

    protected $rules = [
        'title' => 'required',
        'slug' => 'required',
        'body' => 'required',
    ];

    public function mount()
    {
        $this->model = new ModelName();
        $this->model_id = $this->model->id;
    }

    public function delete(int $id)
    {
        $this->authorize('blog_delete');
        $this->model->findOrFail($id)->delete();
        $this->notification()->success('Success', 'Deleted Successfully');
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
        $this->reset(['id', 'title', 'slug', 'body', 'created_at', 'updated_at', 'deleted_at']);
    }

    public function updated()
    {
        $this->setModel('App\\Models\\Blog', 'title');
    }

    public function render()
    {
        $blogs = ModelsBlog::where('title', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);
        return view('livewire.blog.blog', compact('blogs'));
    }
}
