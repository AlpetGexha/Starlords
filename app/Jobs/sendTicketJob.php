<?php

namespace App\Jobs;

use App\Mail\sendTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendTicketJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }


    public function handle()
    {
        Mail::send(new sendTicket($this->ticket));
    }
}
