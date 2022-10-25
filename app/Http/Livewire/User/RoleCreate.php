<?php

namespace App\Http\Livewire\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleCreate extends Component
{
    use WithFileUploads, Actions, AuthorizesRequests;

    public $name, $permissions = [];

    protected $rules = [
        'name' => 'required|min:3|max:255|unique:roles',
        'permissions' => 'required',
    ];

    public function store()
    {
        $this->authorize('user_make_role');
        $this->validate();

        Role::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ])->syncPermissions($this->permissions);

        $this->notification()->success('Success', 'Role created successfully.');
        $this->emit('roleCreated');
        $this->reset();
    }

    public function render()
    {
        $permissions = Permission::with('roles')->select('id', 'name', 'guard_name')->get();
        return view('livewire.user.role-create', compact('permissions'));
    }
}
