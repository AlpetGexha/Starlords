<?php

namespace App\Http\Livewire;

use App\Models\Test as ModelName;
use Livewire\Component;
use Livewire\WithPagination;

class Test extends Component
{
    use WithPagination;

    public $model;
    public $openModelName = false;
    public $name, $model_id;

    protected $rules = [
        'name' => 'required',
    ];

    public function mount()
    {
        $this->model = new ModelName();
        $this->model_id = $this->model->id;
    }

    public function store()
    {
        $this->validate();

        $this->model->create([
            'name' => $this->name,
        ]);

        $this->reset(['name']);
    }

    public function delete(int $id)
    {
        $this->model->findOrFail($id)->delete();
    }

    public function edit(int $id)
    {
        $this->model_id = $id;
        $edit = $this->model->findOrFail($id);
        $this->name = $edit->name;
        $this->open();
    }

    public function update()
    {
        $this->model->findOrFail($this->model_id)->update([
            'name' => $this->name,
        ]);
        $this->close();
        $this->reset(['name']);
    }

    public function close()
    {
        $this->openModelName = false;
    }

    public function open()
    {
        $this->openModelName = true;
    }

    public function render()
    {
        $all = $this->model->fastPaginate(10);
        return view('livewire.test', compact('all'));
    }
}
