<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Backup extends Component
{
    use WithFileUploads, AuthorizesRequests, Actions;

    public $backup_time = null;

    public function backupAll()
    {
        $this->backup_time = null;
        $time_start = microtime(true);
        Artisan::call('backup:run');
        $this->success('Backup created successfully');
        $time_end = microtime(true);
        $this->backup_time = number_format($time_end - $time_start, 2);
    }

    public function backupOnlyFile()
    {
        $this->backup_time = null;
        $time_start = microtime(true);
        Artisan::call('backup:run --only-files');
        $this->success('Backup created successfully');
        $time_end = microtime(true);
        $this->backup_time = number_format($time_end - $time_start, 2);
    }

    public function backupOnlyDB()
    {
        $this->backup_time = null;
        $time_start = microtime(true);
        Artisan::call('backup:run --only-db');
        $this->notification()->success('Success!', 'Database Backup Successfully');
        $time_end = microtime(true);
        $this->backup_time = number_format($time_end - $time_start, 2);
    }

    public function backupDelete()
    {
        $this->backup_time = null;
        $time_start = microtime(true);
        Artisan::call('backup:clean');
        $this->notification()->success('Success!', 'Backup Deleted Successfully');
        $time_end = microtime(true);
        $this->backup_time = number_format($time_end - $time_start, 2);
    }

    public function backupList()
    {
        $this->backup_time = null;
        $time_start = microtime(true);
        Artisan::call('backup:list');
        session()->flash('output', Artisan::output());
        $time_end = microtime(true);
        $this->backup_time = number_format($time_end - $time_start, 2);
    }

    public function backupMonitor()
    {
        $this->backup_time = null;
        $time_start = microtime(true);
        Artisan::call('backup:monitor');
        $this->notification()->success('Success!', 'Backup Monitor');
        session()->flash('output', Artisan::output());
        $time_end = microtime(true);
        $this->backup_time = number_format($time_end - $time_start, 2);
    }

    public function unsetFile($file)
    {
        unlink($file);
        $this->notification()->success('Success!', 'Backup File Deleted Successfully');
    }

    public function cleanOutput()
    {
        session()->forget('output');
        $this->backup_time = null;
    }

    public function render()
    {
        $files = glob(storage_path('app/' . env('APP_NAME') . '/*'));
        return view('livewire.backup', compact('files'));
    }
}
