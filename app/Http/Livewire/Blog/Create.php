<?php

namespace App\Http\Livewire\Blog;

use App\Jobs\NewsletterBlogJob;
use App\Models\Blog;
use App\Models\Newsletter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Create extends Component
{
    use WithFileUploads, Actions, AuthorizesRequests;

    public $title, $body, $photo, $tags = [];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'body' => 'required|min:20',
        'photo' => 'required|image',
    ];

    public function store()
    {
        $this->authorize('blog_create');
        // dd($this->body);
        $this->validate();
        $blog = Blog::create([
            'title' => str()->title($this->title),
            'body' => $this->body,
        ]);

        // send email to all subscribers to notify them about new post
        $emails = Newsletter::where('is_subscribed', true)->get('email');
        $blogs = Blog::where('id', $blog->model_id)->first();

        // attach tags

        $blog->attachTags([implode(',', $this->tags)]);
        $blog->addMedia($this->photo->getRealPath())
            ->toMediaCollection('blog');

        foreach ($emails as $email) {
            dispatch(new NewsletterBlogJob($email->email, $blogs));
        }

        $this->notification()->success('Success', __('Blog created successfully.'));
        return to_route('admin.blog.show');
        $this->reset(['title', 'body', 'photo']);
    }

    public function render()
    {
        return view('livewire.blog.create');
    }
}
