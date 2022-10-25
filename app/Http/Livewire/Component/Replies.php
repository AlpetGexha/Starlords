<?php

namespace App\Http\Livewire\Component;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Replies extends Component
{
    public $model;
    public $comment_id;
    public $reply;

    protected $rules = [
        'reply' => 'required',
    ];

    public function mount(Model $model, int $comment_id)
    {
        $this->model = $model;
        $this->comment_id = $comment_id;
    }

    public function create()
    {
        $this->validate();

        Reply::create([
            'user_id' => auth()->id(),
            'comment_id' => $this->comment_id,
            'body' => $this->reply,
            'replyable_id' => $this->model->id,
            'replyable_type' => get_class($this->model),
        ]);

        $this->emit('replyAdded');
        session()->flash('success', 'Reply added successfully.');
        $this->reset(['reply']);
    }


    public function render()
    {
        return view('livewire.component.replies');
    }
}
