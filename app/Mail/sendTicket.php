<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendTicket extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function build()
    {
        return $this->view('mail.send-ticket', [
            'ticket' => $this->ticket,
        ])
            ->from(env('MAIL_FROM_ADDRESS'))
            ->to(env($this->ticket->email))
            ->subject('Your ticket to  has been sent!');
    }
}
