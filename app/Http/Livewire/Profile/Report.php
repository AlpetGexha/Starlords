<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use WireUi\Traits\Actions;

class Report extends Component
{
    use Actions;

    public $model;
    public $reason;
    public $openReportModal = false;

    protected $rules = [
        'reason' => 'required|min:15|max:2000',
    ];

    public function mount($model)
    {
        $this->model = $model;
    }

    public function open()
    {
        $this->openReportModal = true;
    }

    public function close()
    {
        $this->openReportModal = false;
    }


    public function create()
    {
        $this->validate();

        if ($this->model->report()->where('user_id', auth()->id())->exists()) {
            $this->notification()->error(
                $title = 'Report Reported Fail',
                $description = 'You have already reported this Status'
            );
            $this->close();
            return;
        } elseif ($this->model->report()->where('ip', request()->ip())->exists()) {
            $this->notification()->error(
                $title = 'Report Reported Fail',
                $description = 'You have already reported this Status'
            );
            $this->close();
            return;
        }
        else {
            $this->model->storeReport($this->reason);


            $this->reset(['reason']);
            $this->emit('addReport');

            $this->notification()->success(
                $title = 'Report Reported successfully',
                $description = 'You have successfully reported this Status, Thank you for your help! We will review this profile as soon as possible.'
            );

            $this->close();
        }
    }

    public function render()
    {
        return view('livewire.profile.report');
    }
}
