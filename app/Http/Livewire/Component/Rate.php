<?php

namespace App\Http\Livewire\Component;

use App\Models\Comment;
use Exception;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Livewire\Component;
use Illuminate\Http\Request;
use WireUi\Traits\Actions;

class Rate extends Component
{
    use Authorizable, Actions;

    public $model;
    public $rating, $comment;

    public $openRateModal = false;

    protected $rules = [
        'rating' => 'required|integer|between:1,5',
        'comment' => 'required|string|min:20|max:1000',
    ];

    public function setRating($rate)
    {
        $this->rating = $rate;
    }
    public function create()
    {
        // $this->authorize('auth');
        $this->validate();

        if ($this->model->isRated()) {
            $this->notification()->error('Rated Fail', 'You already rated');
            $this->close();
            // $this->reset(['rating', 'comment']);
            return;
        }

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'body' => $this->comment,
            'commentable_id' => $this->model->id,
            'commentable_type' => get_class($this->model),
        ]);
        $this->model->rate($this->rating, $comment->id, $this->model);

        $this->reset(['rating', 'comment']);
        $this->emit('rateAdded');
        $this->notification()->success('Rated Successful', 'You have successfully rated');
        $this->close();
    }

    public function mount($model)
    {
        $this->model = $model;
    }

    public function open()
    {
        $this->openRateModal = true;
    }

    public function close()
    {
        $this->openRateModal = false;
    }



    public function render()
    {
        return view('livewire.component.rate');
    }
}
