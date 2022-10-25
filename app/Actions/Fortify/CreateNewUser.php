<?php

namespace App\Actions\Fortify;

use App\Jobs\MakeTicketForEmail;
use App\Jobs\UserRegisterMailJob;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;
use Laravel\Socialite\Facades\Socialite;

class CreateNewUser extends Component implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'g-recaptcha-response' => 'required|captcha'
        ])->validate();

        $user = User::create([
            'name' => Str::replace(' ', '', Str::ucfirst($input['name'])),
            'username' => Str::replace(' ', '',  Str::lower($input['username'])),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $job = new UserRegisterMailJob($user);
        dispatch($job);

        // if user buy ticket without
        $makeTicket = new MakeTicketForEmail($user->email, $user->id);
        dispatch($makeTicket);

        return $user;
    }
}
