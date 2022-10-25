<?php

namespace App\Jobs;

use App\Mail\sendMailToUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendMailToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user, $body;

    public function __construct($user, $body)
    {
        $this->user = $user;
        $this->body = $body;
    }

    public function handle()
    {
        Mail::queue(new sendMailToUser($this->user, $this->body));
    }
}
