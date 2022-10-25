<?php

namespace App\Http\Livewire;

use Artisan;
use Livewire\Component;
use WireUi\Actions\Notification;
use WireUi\Traits\Actions;

class RefreshHealth extends Component
{
    use Actions;
    
    public function refreshHealth()
    {
        Artisan::call('health:list --fresh');
        redirect(request()->header('Referer'));
        $this->notification()->success('Success!', 'Health Check Refreshed Successfully');
    }

    public function render()
    {
        return view('livewire.refresh-health');
    }
}
