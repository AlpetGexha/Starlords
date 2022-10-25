<?php

namespace App\Jobs;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MakeTicketForEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $user_id;

    public function __construct($email, $user_id)
    {
        $this->email = $email;
        $this->user_id = $user_id;
    }

    public function handle()
    {
        $ticket = Ticket::where('user_id', null)->where('email', $this->email)->get();
        if ($ticket->count() > 0) {
            foreach ($ticket as $t) {
                $t->user_id = $this->user_id;
                $t->save();
            }
        }
    }
}
