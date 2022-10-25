<?php

namespace App\Http\Controllers;

use App\Jobs\UserRegisterMailJob;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user_provaider = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->route('login');
        }

        $user = User::firstOrCreate(
            [
                'provider_id' => $user_provaider->getId(),
            ],
            [
                'provider' => Str::ucfirst($provider),
                'provider_id' => $user_provaider->id,
                'name' => Str::replace(' ', '', Str::lower(Str::ucfirst($user_provaider->name))),
                'email' => $user_provaider->email,
            ]
        );
        auth()->login($user);

        $job = (new UserRegisterMailJob($user))->delay(now()->addSeconds(1));
        dispatch($job);

        return to_route('homepage');
    }
}
