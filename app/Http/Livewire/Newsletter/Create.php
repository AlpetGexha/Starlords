<?php

namespace App\Http\Livewire\Newsletter;

use App\Jobs\checkSubscribeJob;
use App\Models\Newsletter;
use Illuminate\Support\Str;
use Dirape\Token\Token;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
    public $email;

    public $rules = [
        'email' => 'required|email|unique:newsletters',
    ];

    public function store()
    {
        $token = new Token();
        $this->validate();
        $news = Newsletter::create([
            'email' => $this->email,
            'token' => $token->Unique('newsletters', 'token', 30)
        ]);

        $job = (new checkSubscribeJob($news->email, $news->token));
        dispatch($job);

        $this->notification()->success('Plz check your email to confirm your subscription');
        $this->emit('newsletterCreated');
        $this->reset(['email']);
    }

    public function render()
    {
        return view('livewire.newsletter.create');
    }
}
