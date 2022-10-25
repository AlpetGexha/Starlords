<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class checkSubscribe extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email, $token;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function build()
    {
        return $this
            ->view('mail.send-subscripe',[
                'token' => $this->token,
            ])
            ->from(env('MAIL_FROM_ADDRESS'))
            ->to($this->email)
            ->subject('Subscription to Newsletter on' . env('APP_NAME'));
    }
}
