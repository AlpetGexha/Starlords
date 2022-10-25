<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Ticket extends Component
{
    public $ticket;

    public function mount($ticket)
    {
        $this->ticket = $ticket;
    }

    public function render()
    {
        return view('livewire.ticket', compact('ticket'));
    }
}
