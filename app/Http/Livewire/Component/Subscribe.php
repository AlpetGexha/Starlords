<?php

namespace App\Http\Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use \Overtrue\LaravelSubscribe\Subscription;

class Subscribe extends Component
{
    use AuthorizesRequests;

    public $model;
    public $notify;
    public $isSubscribed;

    public function mount($model)
    {
        $this->model = $model;
        $this->notify = $this->getNotify($model);
    }

    public function sub()
    {
        $this->authorize('auth');

        if ($this->model->isSubscribedBy(auth()->user())) {
            auth()->user()->unsubscribe($this->model);
            return;
        }
        auth()->user()->subscribe($this->model);
    }

    public function notify()
    {
        $this->authorize('auth');

        if ($this->getNotify()) {
            $this->removeNotify();
            return;
        }

        $this->createNotify();
    }

    public function getNotify(): bool
    {
        return Subscription::where('user_id', auth()->id())
            ->where('subscribable_id', $this->model->id)
            ->where('subscribable_type', get_class($this->model))
            ->first()->notify ?? false;
    }

    public function createNotify()
    {
        return Subscription::where('user_id', auth()->id())
            ->where('subscribable_id', $this->model->id)
            ->where('subscribable_type', get_class($this->model))
            ->update(['notify' => 1]);
    }

    public function removeNotify()
    {
        return Subscription::where('user_id', auth()->id())
            ->where('subscribable_id', $this->model->id)
            ->where('subscribable_type', get_class($this->model))
            ->update(['notify' => 0]);
    }

    public function isNotify(): bool
    {
    }


    public function render()
    {
        // dd($this->notify);
        return view('livewire.component.subscribe');
    }
}
