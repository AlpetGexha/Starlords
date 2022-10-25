<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact as ModelName;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSorting;
use App\Traits\WithCheckbox;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use WireUi\Traits\Actions;

class Contact extends Component
{
    use WithPagination, Actions, WithCheckbox, WithSorting, AuthorizesRequests;

    public $name, $email, $subject, $message;

    public $model;
    public $openModelName = false;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'desc', 'as' => 'dir'],
    ];

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'subject' => 'required',
        'message' => 'required',
    ];

    public function mount()
    {
        $this->model = new ModelName();
        $this->model_id = $this->model->id;
    }

    public function store()
    {
        $this->validate();

        Contact::create([

            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->resetAttributes();
    }

    public function delete(int $id)
    {
        $this->authorize('contact_delete');
        $this->model->findOrFail($id)->delete();
        $this->notification()->success('Success', 'Deleted Successfully');
    }

    public function edit(int $id)
    {
        $this->open();
        $this->model_id = $id;
        $edit = ModelName::findOrFail($id);

        $this->name = $edit->name;
        $this->email = $edit->email;
        $this->subject = $edit->subject;
        $this->message = $edit->message;
    }

    public function update()
    {
        ModelName::findOrFail($this->model_id)->update([

            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);
        $this->close();
        $this->resetAttributes();
    }

    public function close()
    {
        $this->openModelName = false;
    }

    public function open()
    {
        $this->openModelName = true;
    }

    public function resetAttributes()
    {
        $this->reset(['id', 'name', 'email', 'subject', 'message', 'created_at', 'updated_at']);
    }

    public function updated()
    {
        $this->setModel('App\\Models\\Contact', 'subject');
    }

    public function render()
    {
        $contacts = $this->model
            ::where('subject', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);
        return view('livewire.contact.contact', compact('contacts'));
    }
}
