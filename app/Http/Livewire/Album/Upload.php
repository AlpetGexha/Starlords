<?php

namespace App\Http\Livewire\Album;

use App\Models\Album;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $profile;

    public $rules = [
        'photos' => 'required|image|type:jpeg,png,jpg',
    ];

    public function mount(int $profile)
    {
        $this->profile = $profile;
    }

    public function store()
    {
        // $this->validate();

        foreach ($this->photos as $photo) {
            $image = Album::create([
                'profile_id' => $this->profile,
            ]);
            $image->addMedia($photo->getRealPath())->toMediaCollection('album');
        }

        $this->reset();
    }

    public function render()
    {
        return view('livewire.album.upload');
    }
}
