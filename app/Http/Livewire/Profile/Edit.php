<?php

namespace App\Http\Livewire\Profile;

use App\Models\EventCategory;
use App\Models\Profile;
use App\Rules\Facebook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Termwind\Components\Dd;
use WireUi\Traits\Actions;

class Edit extends Component
{

    use WithFileUploads, Actions;

    public $name, $email, $number, $description, $location, $avatar, $link,
        $website, $linkedin, $facebook, $instagram, $twitter,
        $categorys = [], $tags;

    public $rules = [
        'name' => 'required|min:3|max:255|string',
        'email' => 'required|email|string',
        'number' => 'required|integer|min:11|max:13',
        'website' => 'nullable|url',
        'description' => 'required|min:30|max:255|string',
        'location' => 'required|min:3|max:255|string',
        'tags' => 'required|min:2|max:255|string',
    ];

    public function mount(Model $model)
    {
        // $model->load('tags');
        // dd($model);
        $this->categorys =  $model->category;
        $this->name = $model->name;
        $this->email = $model->email;
        $this->number = $model->phone;
        $this->description = $model->body;
        $this->location = $model->location;
        $this->avatar = $model->avatar;
        $this->link = $model->link;
        $this->website = $model->website;
        $this->linkedin = $model->linkedin;
        $this->facebook = $model->facebook;
        $this->instagram = $model->instagram;
        $this->twitter = $model->twitter;
        $this->tags = $model->tags;
    }

    public function update()
    {
        $this->validate([
            'name'          => 'required|min:3|max:255|string',
            'email'         => 'required|email|string',
            'number'        => 'required|integer|min:11',
            'website'       => 'nullable|url',
            'description'   => 'required|min:30|string',
            'categorys'      => 'required',
            'location'      => 'required|min:3|max:255|string',
            'avatar'        => 'image|mimes:jpeg,png,jpg,gif,svg',
            'link'          => 'nullable|url',
            'facebook'       => ['nullable', 'url', new \App\Rules\Facebook],
            'linkedin'      => ['nullable', 'url', new \App\Rules\Linkedin],
            'twitter'       => ['nullable', 'url', new \App\Rules\Twitter],
            'instagram'     => ['nullable', 'url', new \App\Rules\Instagram],
        ]);


        // update profile
        $profile = Profile::where('user_id', auth()->user()->id)->first();
        $profile->name = $this->name;
        $profile->email = $this->email;
        $profile->phone = $this->number;
        $profile->website = $this->website;
        $profile->body = $this->description;
        $profile->location = $this->location;
        $profile->link = $this->link;
        $profile->facebook = $this->facebook;
        $profile->linkedin = $this->linkedin;
        $profile->twitter = $this->twitter;
        $profile->instagram = $this->instagram;
        $profile->attachTags($this->tags);
        $profile->addMedia($this->avatar->getRealPath())->toMediaCollection('profile');
        $profile->save();

        $this->emit('UpdateProfile');
        $this->notification()->success('Success!', 'Profile has been updated successfully.');
        return to_route('profile.single', ['profile' => $profile->slug]);
        // $this->reset(['name', 'email', 'number', 'description', 'location', 'avatar', 'link', 'website', 'linkedin', 'facebook', 'instagram', 'twitter', 'categorys', 'tags']);
    }

    public function render()
    {
        $categoryss = EventCategory::select('title')->orderBy('id', 'desc')->get();
        // dd($this->categorys);
        return view('livewire.profile.edit', compact('categoryss'));
    }
}
