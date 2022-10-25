<?php

namespace App\Http\Livewire\Setting;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSorting;
use App\Traits\WithCheckbox;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Settings extends Component
{
    use WithPagination, WithFileUploads, Actions, WithCheckbox, WithSorting, AuthorizesRequests;

    public $openModal = false;
    public $setting_id;

    public $setting_key, $serring_group, $name;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'desc', 'as' => 'dir'],
    ];

    public $rules = [
        'setting_key' => 'required'
    ];

    public function mount()
    {
        $this->authorize('settings_access');
    }

    public function delete(int $id)
    {
        $this->authorize('settings_delete');
    }

    public function edit(int $id)
    {
        $this->openModal = true;
        $this->setting_id = $id;
        $setting = DB::table('settings')->where('id', $id)->first();

        $this->serring_group = $setting->group;
        $this->name = $setting->name;
        $this->setting_key = Str::removeFirstLast($setting->payload);
    }

    public function update()
    {
        $this->authorize('settings_update');

        if ($this->setting_id) {
            // $setting = DB::table('settings')->where('id', $this->setting_id)->get();
            // $setting->payload = $this->setting_key;
            // $setting->save();
            $this->validate();
            $setting = DB::table('settings')->where('id', $this->setting_id)->update([
                'payload' => Str::addFirstLast($this->setting_key, '"')
            ]);
            $this->openModal = false;
            $this->notification()->success('Success', 'Setting updated successfully.');
        } else
            $this->notification()->error('Error', 'Setting not found.');
    }

    public function render()
    {
        $settings = DB::table('settings')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->paginate_page);
        return view('livewire.setting.settings', compact('settings'));
    }
}
