<?php

namespace App\Http\Livewire\Component;

use App\Models\Event;
use Livewire\Component;

class Like extends Component
{
    public Event $model;
    public int $count;

    public function mount(Event $model)
    {
        $this->model = $model;
        $this->count = $model->likes_count;
    }

    public function like(): void
    {
        if ($this->model->isLiked()) {
            $this->model->removeLike();

            $this->count--;
        } elseif (auth()->user()) {
            $this->model->likes()->create([
                'user_id' => auth()->id(),
            ]);

            $this->count++;
        } elseif (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            $this->model->likes()->create([
                'ip' => $ip,
                'user_agent' => $userAgent,
            ]);

            $this->count++;
        }
    }



    public function render()
    {
        return view('livewire.component.like');
    }
}
