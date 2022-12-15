<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use TheSeer\Tokenizer\Exception;

class Stats extends Component
{
    public $model = null, $table = null;
    public $name;

    public $days;
    public $count;


    public function mount($name, $model = null, $table = null)
    {
        if (is_null($model) && is_null($table)) {
            throw new Exception('Model or Table is required');
        }
        if (isset($model) && isset($table)) {
            throw new Exception('Model and Table cant be used only one can be use on component');
        }

        // model and table cant be both null but only one need to be null

        $this->name = $name;
        $this->model = $model;
        $this->table = $table;
        $this->updateStats();
    }

    public function updateStats()
    {
        if ($this->model) {
            $this->count = $this->model::query()
                ->when($this->days, fn ($q) => $q->where('created_at', '>=', now()->subDays($this->days)))
                ->count();
        } else if ($this->table) {
            $this->count = DB::table($this->table)
                ->when($this->days, fn ($q) => $q->where('created_at', '>=', now()->subDays($this->days)))
                ->count('id');
        }
    }


    public function render()
    {
        return view('livewire.admin.stats');
    }
}
