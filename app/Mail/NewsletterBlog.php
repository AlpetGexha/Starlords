<?php

namespace App\Mail;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterBlog extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public $email;
    public $post;

    public function __construct($email, $post)
    {
        $this->email = $email;
        $this->post = $post;
    }

    public function build()
    {
        return $this
            ->view('mail.newsletter-blog', [
                'post' => $this->post,
            ])
           ->from(env('MAIL_FROM_ADDRESS'))
           ->to($this->email)
           ->subject(env('APP_NAME') . 'Just published a new post');
    }
}
