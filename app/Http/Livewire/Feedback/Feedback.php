<?php

namespace App\Http\Livewire\Feedback;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSorting;
use App\Traits\WithCheckbox;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use WireUi\Traits\Actions;

class Feedback extends Component
{

    use WithPagination, Actions, WithCheckbox, WithSorting, AuthorizesRequests;

    public $type, $message, $reviewed;

    public $openModelName = false;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'desc', 'as' => 'dir'],
    ];


    public function delete(int $id)
    {
        $this->authorize('admin_show');
        DB::table('feedbacks')->where('id', $id)->delete();
        $this->notification()->success('Success', 'Deleted Successfully');
    }

    public function edit(int $id)
    {
        $this->open();
        $edit = DB::table('feedbacks')->where('id', $id)->first();

        $this->type = $edit->type;
        $this->message = $edit->message;
        $this->reviewed = $edit->reviewed;
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
        $feedbacks = DB::table('feedbacks')
            ->where('type', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate_page);
        return view('livewire.feedback.feedback', compact('feedbacks'));
    }
}
