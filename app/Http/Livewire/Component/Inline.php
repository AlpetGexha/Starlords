<?php

namespace App\Http\Livewire\Component;

use Illuminate\Support\Str;
use Livewire\Component;
use WireUi\Traits\Actions;

class Inline extends Component
{
    use Actions;
    public $origName;
    public $entityId;
    public $shortId;
    public $slug;
    public $newName; // dirty operation name state
    public $isName; // determines whether to display it in bold text
    public string $field; // this is can be column. It comes from the blade-view foreach($fields as $field)
    public string $model; // Eloquent model with full name-space

    protected $rules = [
        'newName' => 'required|min:2',
    ];


    public function mount($model, $entity, $slug = false)
    {
        $this->entityId = $entity->id;
        $this->shortId = $entity->short_id;
        $this->origName = $entity->{$this->field};
        $this->slug = $slug;
        $this->init($this->model, $entity); // initialize the component state
    }

    public function save()
    {
        $this->validate();

        $entity = $this->model::findOrFail($this->entityId);
        $newName = (string)Str::of($this->newName)->trim(); // trim whitespace & more than 100 characters
        $newName = $newName === $this->shortId ? null : $newName; // don't save it as operation name it if it's identical to the short_id

        $entity->{$this->field} = $newName ?? null;
        if ($entity->save()) {
            $this->init($this->model, $entity);
            $this->notification()->success('Successfully', "Operation <i>{$this->origName}</i> has been renamed to <b>{$newName}</b>");
            if ($this->slug) {
                $entity->update(['slug' => Str::slug($newName)]);
            }
        }
    }

    private function init($model, $entity)
    {
        $this->origName = $entity->{$this->field} ?: $this->shortId;
        $this->newName = $this->origName;
        $this->isName = $entity->{$this->field} ?? false;
    }

    public function render()
    {
        return view('livewire.component.inline');
    }
}
