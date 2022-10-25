<?php

namespace App\Http\Livewire\Component;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Status extends Component
{

    public Model $model;

    public $field;

    public $isActive;

    public function mount()
    {
        $this->isActive = (bool) $this->model->getAttribute($this->field);
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
    }

    public function render()
    {
        return view('livewire.component.status');
    }
}
