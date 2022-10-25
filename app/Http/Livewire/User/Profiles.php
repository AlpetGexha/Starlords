<?php

namespace App\Http\Livewire\User;

use App\Models\EventCategory;
use App\Models\Profile;
use App\Rules\Facebook;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Profiles extends Component
{

    use WithFileUploads, Actions;

    public $name, $email, $number, $description, $location, $avatar, $link,
        $website, $linkedin, $facebook, $instagram, $twitter,
        $categorys = [], $tags;

    // public $rules = [
    //     'name' => 'required|min:3|max:255|unique:profiles|string',
    //     'email' => 'required|email|string',
    //     'number' => 'required|integer|min:11|max:13',
    //     'website' => 'nullable|url',
    //     'description' => 'required|min:30|max:255|string',
    //     'location' => 'required|min:3|max:255|string',
    // ];

    public function create()
    {
        $this->validate([
            'name'          => 'required|min:3|max:255|unique:profiles|string',
            'email'         => 'required|email|string',
            'number'        => 'required|integer|min:11',
            'website'       => 'nullable|url',
            'description'   => 'required|min:30|string',
            'categorys'      => 'required',
            'location'      => 'required|min:3|max:255|string',
            'avatar'        => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'link'          => 'nullable|url',
            'facebook'       => ['nullable', 'url', new \App\Rules\Facebook],
            'linkedin'      => ['nullable', 'url', new \App\Rules\Linkedin],
            'twitter'       => ['nullable', 'url', new \App\Rules\Twitter],
            'instagram'     => ['nullable', 'url', new \App\Rules\Instagram],
        ]);

        $profile = Profile::create([
            'name'          => Str::title($this->name),
            'email'         => Str::lower(str_replace(' ', '', $this->email)),
            'phone'         => $this->number,
            'website'       => Str::lower(str_replace(' ', '', $this->website)),
            'body'          => $this->description,
            'location'      => $this->location,
            'category'      => $this->categorys,
            'facebook'      => Str::lower(str_replace(' ', '', $this->facebook)),
            'linkedin'      => Str::lower(str_replace(' ', '', $this->linkedin)),
            'instagram'     => Str::lower(str_replace(' ', '', $this->instagram)),
            'twitter'       => Str::lower(str_replace(' ', '', $this->twitter)),
            'link'          => Str::lower(str_replace(' ', '', $this->link)),
        ]);
        $profile->attachTags($this->tags);
        $profile->addMedia($this->avatar->getRealPath())->toMediaCollection('profile');
        $this->emit('create');
        $this->notification()->success('Success!', 'Profile created successfully');
        return to_route('profile.single', ['profile' => $profile->slug]);
        // $this->reset(['name', 'email', 'number', 'description', 'location', 'avatar', 'link', 'website', 'linkedin', 'facebook', 'instagram', 'twitter', 'categorys', 'tags']);
    }

    public function render()
    {
        $categoryss = EventCategory::select('title')->orderBy('id', 'desc')->get();
        // dd($categorys);
        return view('livewire.user.profiles', compact('categoryss'));
    }
}
