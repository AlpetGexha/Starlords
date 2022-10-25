<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class PrintTicket extends Component
{
    public $ticket;

    public function mount(Model $ticket)
    {
        $this->ticket = $ticket;
    }

    public function printTicket()
    {
        $pdf = PDF::loadView('livewire.ticket', ['ticket' => $this->ticket]);
        return $pdf->download('ticket.pdf');
        // dd($pdf);

        // return PDF::loadHTML('<h1>Hello</h1>')->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
    }

    public function render()
    {
        return view('livewire.print-ticket');
    }
}
