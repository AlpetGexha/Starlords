<?php

namespace App\Http\Livewire\Sponzor;

use App\Models\Sponzor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions, AuthorizesRequests;

    public $url_image, $url, $name;

    protected $rules = [
        'url_image' => 'required|url',
        'url' => 'required|url',
        'name' => 'required|min:3|max:255',
    ];

    public function store()
    {
        $this->authorize('admin_show');
        $this->validate();

        Sponzor::create([
            'url_image' => $this->url_image,
            'url' => $this->url,
            'name' => $this->name,
        ]);

        $this->notification()->success('Success', __('Sponzor created successfully.'));
        $this->reset(['url_image', 'url', 'name']);
    }

    public function render()
    {
        return view('livewire.sponzor.create');
    }
}
