<?php

namespace App\Http\Livewire\Component;

use App\Models\Comment as ModelsComment;
use App\Models\Event;
use App\Traits\withLoadMore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{

    use AuthorizesRequests, WithPagination, WithLoadMore;

    public $comment;
    public $model;
    public $count;

    protected $rules = [
        'comment' => 'required|min:3',
    ];

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->count = $model->comments_count;
    }

    public function create()
    {
        $this->authorize('auth');
        $this->validate();

        auth()->user()->comments()->create([
            'body' => $this->comment,
            'commentable_id' => $this->model->id,
            'commentable_type' => get_class($this->model),
        ]);
        $this->emit('addComment');
        session()->flash('success', 'Comment added successfully.');
        $this->reset(['comment']);
    }

    public function render()
    {
        // get reply_count
        return view('livewire.component.comment');
    }
}
