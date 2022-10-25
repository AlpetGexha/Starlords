<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMailToUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    public $user, $body;

    public function __construct($user, $body)
    {
        $this->user = $user;
        $this->body = $body;
    }

    public function build()
    {
        return $this->markdown('mail.send-mail', [
            'body' => $this->body
        ])
            ->from(env('MAIL_FROM_ADDRESS')) //emaili yne
            ->to($this->user->email) //emaili i perdoruesit
            ->subject('Welcome to ' . env('APP_NAME')); //subjekti(titulli)
    }
}
