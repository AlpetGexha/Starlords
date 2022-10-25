<?php

namespace App\Http\Livewire\Component;

use App\Models\User;
use App\Traits\Wishlist\WishlistFacade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Wishlist extends Component
{
    use AuthorizesRequests;

    public Model $model;
    public  $isWished;

    public function mount(Model $model)
    {
        $this->model = $model;
    }

    public function wish()
    {
        $this->authorize('auth');

        if ($this->model->isWished()) {
            auth()->user()->unwish($this->model);
        } else {
            auth()->user()->wish($this->model);
        }
    }

    public function createWish()
    {
    }

    public function unwish()
    {
    }

    public function isWhished(): bool
    {
        $this->isWished = auth()->user()->hasModelOnList($this->model);
    }

    public function render()
    {
        return view('livewire.component.wishlist');
    }
}
