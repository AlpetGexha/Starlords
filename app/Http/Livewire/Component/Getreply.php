<?php

namespace App\Http\Livewire\Component;

use App\Models\Reply;
use App\Traits\WithLoadMore;
use Livewire\Component;
use Livewire\WithPagination;

class Getreply extends Component
{

    use WithLoadMore, WithPagination;


    public $model;
    public $comment_id;

    protected $listeners = ['replyAdded' => '$refresh', 'addComment' => '$refresh'];

    public function mount($model, $comment_id)
    {
        $this->model = $model;
        $this->comment_id = $comment_id;
        $this->perPage = 1;
    }

    public function render()
    {
        $replys = Reply::where('comment_id', $this->comment_id)
            ->where('replyable_id', $this->model->id)
            ->where('replyable_type', get_class($this->model))
            ->fastPaginate($this->perPage);
        return view('livewire.component.getreply', compact('replys'));
    }
}
