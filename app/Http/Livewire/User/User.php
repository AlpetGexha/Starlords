<?php

namespace App\Http\Livewire\User;

use App\Jobs\sendMailToUserJob;
use App\Models\User as ModelsUser;
use App\Traits\WithCheckbox;
use App\Traits\WithSorting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Spatie\Permission\Models\Role;
use Illuminate\Support\LazyCollection;


class User extends Component
{
    use WithPagination, Actions, WithCheckbox, WithSorting, AuthorizesRequests;

    public $name, $username, $email, $two_factor_secret, $two_factor_recovery_codes, $two_factor_confirmed_at, $provider, $provider_id, $current_team_id, $profile_photo_path, $banned_till,
        $banned_reason = "U Have been Banned !",
        $roles = [];

    public $model;
    public $openModelName = false, $openModelBan = false, $openModelRole = false;

    public $search;
    public $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => '', 'as' => 'q'],
        'sortDirection' => ['except' => 'desc', 'as' => 'dir'],
    ];

    public function mount()
    {
        $this->model = new ModelsUser();
        $this->model_id = $this->model->id;
    }

    public function store()
    {
        $this->validate();

        ModelsUser::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'two_factor_secret' => $this->two_factor_secret,
            'two_factor_recovery_codes' => $this->two_factor_recovery_codes,
            'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
            'current_team_id' => $this->current_team_id,
            'profile_photo_path' => $this->profile_photo_path,
        ]);

        $this->resetAttributes();
    }

    public function delete(int $id)
    {
        $this->authorize('user_delete');

        if ($id == auth()->user()->id) {
            $this->notification()->error('Fail!', 'You can not delete yourself');
            return;
        }

        ModelsUser::findOrFail($id)->delete();

        $this->notification()->success(
            'User Delete Successfull',
            'Your has Delete Successefull, also all the data this user have like (Profile, Event, Stats ...)'
        );
    }

    public function deleteSelectIteams(array $row)
    {
        $this->authorize('user_delete');

        if (in_array(auth()->id(), $this->selectIteams)) {
            $this->notification()->error('Fail!', 'You can not delete yourself');
            return;
        }

        $this->model::whereIn('id', $row)->delete();
        // dd($row);
        session()->flash('success', ' ' . count($row) . ' column deleted successfully');
        $this->notification()->success('Success', count($row) . ' column deleted successfully');
        $row = [];
        $this->dispatchBrowserEvent('colum-deleted');
        $this->blankFild();
    }

    public function edit(int $id)
    {
        $this->open();
        $this->model_id = $id;
        $edit = ModelsUser::findOrFail($id);

        $this->name = $edit->name;
        $this->username = $edit->username;
        $this->email = $edit->email;
        $this->two_factor_secret = $edit->two_factor_secret;
        $this->two_factor_recovery_codes = $edit->two_factor_recovery_codes;
        $this->two_factor_confirmed_at = $edit->two_factor_confirmed_at;
        $this->provider = $edit->provider;
        $this->provider_id = $edit->provider_id;
        $this->current_team_id = $edit->current_team_id;
        $this->profile_photo_path = $edit->profile_photo_path;
    }

    public function update()
    {
        ModelsUser::findOrFail($this->model_id)->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'two_factor_secret' => $this->two_factor_secret,
            'two_factor_recovery_codes' => $this->two_factor_recovery_codes,
            'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
            'current_team_id' => $this->current_team_id,
            'profile_photo_path' => $this->profile_photo_path,
        ]);
        $this->close();
        $this->resetAttributes();
    }

    public function openBan(int $id)
    {
        $this->authorize('user_give_ban');

        $this->model_id = $id;
        $user = ModelsUser::find($id);
        $this->name = $user->username();
        $this->openModelBan = true;
    }

    public function ban()
    {
        $this->authorize('user_give_ban');

        $this->validate([
            'banned_till' => 'required',
            'banned_reason' => 'required'
        ]);

        if ($this->model_id) {
            $userBanTime = \Carbon\Carbon::now()->addDays($this->banned_till);
            $user = ModelsUser::find($this->model_id);

            if ($this->banned_till == 0) {
                $user->banned_till = 0;
            } else {
                $user->banned_till = $userBanTime;
            }

            //flase if  user id is same with auth id
            if (auth()->user()->id === $user->id) {
                session()->flash('success', 'Ju nuk mund ta suspendoni veten');
                return false;
            }

            if ($user->save()) {
                $this->notification()->success(
                    'User Has Been BAN',
                    "{$this->name} has been banned for {$this->banned_till} Day"
                );
                $this->openModelBan = false;
                $this->reset(['name', 'banned_till', 'banned_reason']);
                $this->emit('banUser');
                Cache::forget('user-is-online-' . $user->id);
                $job = new sendMailToUserJob($user, $this->banned_reason);
                dispatch($job);
            }
        }
    }

    public function unban(int $id)
    {
        $this->authorize('user_give_unban');

        $user = ModelsUser::find($id);
        $user->banend_reason = null;
        $user->banned_till = null;
        if ($user->save()) {
            $this->notification()->success(
                'User Has been Unbanned Successfull',
                "User {$user->name} has been UnBanned"
            );
            $this->emit('unbanUser');
            $job = new sendMailToUserJob($user, 'U have Been UnBanned from the system');
            dispatch($job);
        }
    }

    public function openRole(int $id)
    {
        $this->authorize('user_give_role');
        $this->model_id = $id;
        $this->model = ModelsUser::find($id);
        $this->name = $this->model->username();
        $this->openModelRole = true;
    }

    public function role()
    {
        $this->authorize('user_give_role');
        if ($this->model_id) {
            $user = ModelsUser::find($this->model_id);
            $user->roles()->sync($this->roles);
            $this->openModelRole = false;
            $this->reset(['name', 'roles']);
            $this->notification()->success(
                'User Has been Role Successfull',
                "User {$user->name} has been Role"
            );
        }
    }

    public function verify(int $id)
    {
        $this->authorize('user_give_verify');

        $user =  ModelsUser::findOrFail($id);
        $user->update(['is_verified' => 1]);

        $this->notification()->success('Success!', "User {$user->name} has been Verified");
        $this->emit('verifyUser');

        $job = new sendMailToUserJob($user, 'Ur Account have Been Verified congrats');
        dispatch($job);
    }

    public function unVerify(int $id)
    {
        $this->authorize('user_give_verify');

        $user =  ModelsUser::findOrFail($id);
        $user->update(['is_verified' => 0]);

        $this->notification()->success('Success! ', "User {$user->name} has been UnVerified");
        $this->emit('unVerifyUser');

        $job = new sendMailToUserJob($user, 'Ur Account have Been UnVerified! plz contact admin for more info');
        dispatch($job);
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
        $this->reset(['id', 'name', 'username', 'email', 'provider', 'provider_id', 'profile_photo_path', 'banned_till', 'banned_reason', 'updated_at']);
    }

    public function updated()
    {
        $this->setModel(ModelsUser::class, 'name');
    }

    public function render()
    {

        $users = ModelsUser::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->with('roles')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->fastPaginate($this->paginate_page);

        $get_roles = Role::all()->pluck('id', 'name');
        return view('livewire.user.user', compact('users', 'get_roles'));
    }
}
