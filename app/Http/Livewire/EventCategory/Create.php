<?php

namespace App\Http\Livewire\EventCategory;

use App\Models\EventCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Create extends Component
{
    use WithFileUploads, Actions, AuthorizesRequests;

    public $title, $body, $photo;

    protected $rules = [
        'title' => 'required',
        'body' => 'required',
        'photo' => 'required|image',
    ];

    public function store()
    {
        $this->authorize('category_access');
        $this->validate();

        EventCategory::create([
            'title' => $this->title,
            'body' => $this->body,
            'slug' => Str::slug($this->title)
        ])
            ->addMedia($this->photo->getRealPath())
            ->toMediaCollection('event_category');

        $this->notification()->success('Success', __('Event category created successfully.'));
        $this->reset(['title', 'body', 'photo']);
    }


    public function render()
    {
        return view('livewire.event-category.create');
    }
}
