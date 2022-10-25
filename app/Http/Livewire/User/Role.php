<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSorting;
use App\Traits\WithCheckbox;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role as ModelsRole;
use WireUi\Traits\Actions;

class Role extends Component
{
    use WithPagination, Actions, WithCheckbox, WithSorting, AuthorizesRequests;

    public $name, $guard_name, $permissions;

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

    public function delete(int $id)
    {
        $this->authorize('user_make_role');
        // Check if role is super admin
        $role = ModelsRole::findOrFail($id);

        if ($role->name === 'SuperAdmin') {
            $this->notification()->error('Error', 'You can not delete SuperAdmin role');
            return;
        }
        $role->delete();
        $this->notification()->success('Success', "Role {$role->name} Deleted Successfully");
    }

    public function render()
    {
        $roles = ModelsRole::where('name', 'like', '%' . $this->search . '%')
            ->select('id', 'name', 'guard_name')
            ->with('permissions:id,name')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);
        // dd($roles);
        return view('livewire.user.role', compact('roles'));
    }
}
