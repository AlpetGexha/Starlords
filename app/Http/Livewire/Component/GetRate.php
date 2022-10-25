<?php

namespace App\Http\Livewire\Component;

use App\Models\Comment;
use App\Models\Rate;
use App\Traits\WithLoadMore;
use Livewire\Component;
use Livewire\WithPagination;

class GetRate extends Component
{
    use WithLoadMore, WithPagination;

    public $model;
    public $avg;
    protected $listeners = ['rateAdded' => '$refresh'];

    public function mount($model)
    {
        $this->model = $model;
    }

    public function render()
    {
        // This query is n+1
        // $comments = $this->model->ratings()
        //     ->with([
        //         'comments' => fn ($q) => $q->with('user:id,name')->take($this->perPage),
        //     ])
        //     ->orderBy('id', 'DESC')
        //     ->first();
        $comments = Comment::where('commentable_id', $this->model->id)
            ->where('commentable_type', get_class($this->model))
            ->with('user:id,name,username')
            ->orderBy('id', 'DESC')
            ->fastPaginate($this->perPage);
        return view('livewire.component.get-rate', compact('comments'));
    }
}
