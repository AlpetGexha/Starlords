<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Profile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Create extends Component
{
    use WithFileUploads, AuthorizesRequests, Actions;

    public $title, $body, $price, $start_date, $end_date, $categorys = [], $tags = [], $location, $profile_id, $photo;

    protected $rules = [
        'title'      => 'required|min:3',
        'body'       => 'required|min:3',
        'price'      => 'required|numeric',
        'start_date' => 'required|date',
        'end_date'   => 'required|date',
        'location'   => 'required|min:3',
        'photo'      => 'required|image|mimes:jpeg,png,jpg,svg',
    ];

    public function store()
    {
        $this->authorize('auth');
        // dd($this->price);
        $this->validate();

        // dd($this->categorys);

        $event = Event::create([
            'user_id'    => auth()->id(),
            'profile_id' => $this->profile_id,
            'title'      => Str::title($this->title),
            'slug'       => Str::slug($this->title),
            'body'       => $this->body,
            'price'      => $this->price,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date,
            'location'   => $this->location,
            // 'categorys'  => $this->categorys,
        ]);
        $event->attachTag(implode(',', $this->tags));
        $event->addMedia($this->photo->getRealPath())->toMediaCollection('event');

        foreach ($this->categorys as $category) {
            $event->category()->attach($category);
        }

        $this->emit('event created');
        $this->notification()->success('Success!', 'Event created successfully');
        return to_route('event.single', ['event' => $event->slug]);
        $this->reset();
    }

    public function render()
    {
        $categoryss = EventCategory::select('id', 'title')->get();
        $profiles = Profile::where('user_id', auth()->id())->select('id', 'name')->get();
        return view('livewire.event.create', compact('categoryss', 'profiles'));
    }
}
