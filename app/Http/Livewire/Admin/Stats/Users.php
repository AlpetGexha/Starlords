<?php

namespace App\Http\Livewire\Admin\Stats;

use App\Models\User;
use Livewire\Component;
use Stripe\ApiOperations\Update;

class Users extends Component
{
    public $days;
    public $count;


    public function mount()
    {
        $this->updateStats();
    }

    public function updateStats()
    {
        $this->count = User::query()
            ->when($this->days, fn ($q) => $q->where('created_at', '>=', now()->subDays($this->days)))
            ->count();
    }

    public function render()
    {
        return view('livewire.admin.stats.users');
    }
}
