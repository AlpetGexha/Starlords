<?php

namespace App\Http\Livewire\Contact;

use App\Http\Requests\ContactRequest as R;
use App\Models\Contact;
use Illuminate\Http\Request;
use Livewire\Component;
use RateLimiter;

class Create extends Component
{
    public $name, $email, $subject, $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ];

    public function store(Request $r)
    {
        $this->validate();

        if (RateLimiter::remaining('send-contact:' . $r->ip(), $perMinute = 1)) {
            RateLimiter::hit('send-contact:' . $r->ip());

            $contact = Contact::create([
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'message' => $this->message,
            ]);

            $this->reset();
            session()->flash('success', 'Your message has been sent successfully.');
            $this->emit('contactStored', $contact);
        } else {
            $seconds = RateLimiter::availableIn('send-contact:' . $r->ip());
            session()->flash('warning', 'You may try again in ' . $seconds . ' seconds.');
        }
    }

    public function render()
    {
        return view('livewire.contact.create');
    }
}
