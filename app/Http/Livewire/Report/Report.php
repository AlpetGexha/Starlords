<?php

namespace App\Http\Livewire\Report;

use App\Models\Report as ModelName;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSorting;
use App\Traits\WithCheckbox;
use WireUi\Traits\Actions;

class Report extends Component
{
    use WithPagination, Actions, WithCheckbox, WithSorting;

    public $user_id, $ip, $user_agent, $reportable_type, $reportable_id, $reason, $collection_name;

    public $model_name;

    public $model;
    public $openModelName = false;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'asc', 'as' => 'dir'],
    ];

    protected $rules = [
        'reportable_type' => 'required',
        'reportable_id' => 'required',
        'reason' => 'required',
        'collection_name' => 'required',
    ];

    public function mount()
    {
        $this->model = new ModelName();
        $this->model_id = $this->model->id;
    }

    public function updated()
    {
        $this->setModel('App\\Models\\Report', 'reason');
    }

    public function render()
    {
        $all = $this->model
            ::where('reason', 'like', '%' . $this->search . '%')
            ->where('reportable_type', 'like', '%' . $this->model_name . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);

        $report_models = $this->model
            ::select('reportable_type')
            ->groupBy('reportable_type')
            ->get();

        return view('livewire.report.report', compact('all', 'report_models'));
    }
}
