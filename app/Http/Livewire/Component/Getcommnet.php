<?php

namespace App\Http\Livewire\Component;

use App\Models\Comment;
use App\Traits\WithLoadMore;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

class Getcommnet extends Component
{
    use WithPagination, WithLoadMore;

    protected $listeners = ['addComment' => '$refresh'];

    public $test = false;
    public $model;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->count = $this->model->comments_count;
    }

    public function render()
    {
        $comments = Comment::where('commentable_id', $this->model->id)
            ->where('commentable_type', get_class($this->model))
            ->with('user')
            ->orderBy('id', 'DESC')
            ->fastPaginate($this->perPage);

        $count = $this->model->comments_count;

        return view('livewire.component.getcommnet', compact('comments', 'count'));
    }
}
