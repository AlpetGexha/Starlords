<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class FileOnClick extends Component
{
    use WithFileUploads, Actions;

    public $model;
    public $onFileEditPhoto;
    public $image_id;
    public $image_name;

    public function mount($model, $image_id, $image_name)
    {
        $this->model = $model;
        $this->image_id = $image_id;
        $this->image_name = $image_name;
    }

    public function updatedOnFileEditPhoto()
    {
        $setting = $this->model::find($this->image_id);

        $setting
            ->addMedia($this->onFileEditPhoto->getRealPath())
            ->toMediaCollection($this->image_name);

        if ($setting)
            $this->notification()->success('Success', __('Image uploaded successfully.'));
        else
            throw new \Exception('Error uploading image. on '.__FILE__.' at line '.__LINE__);

        // session()->flash('success', 'Foto u ndryshua me sukses');
    }

    public function render()
    {
        return view('livewire.component.file-on-click');
    }
}
