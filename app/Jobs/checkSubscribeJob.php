<?php

namespace App\Jobs;

use App\Mail\checkSubscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class checkSubscribeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email, $token;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function handle()
    {
        Mail::queue(new checkSubscribe($this->email, $this->token));
    }
}
