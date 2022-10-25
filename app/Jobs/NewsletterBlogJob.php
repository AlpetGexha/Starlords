<?php

namespace App\Jobs;

use App\Mail\NewsletterBlog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewsletterBlogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email, $post;

    public function __construct($email, $post)
    {
        $this->email = $email;
        $this->post = $post;
    }

    public function handle()
    {
        Mail::queue(new NewsletterBlog($this->email, $this->post));
    }
}
