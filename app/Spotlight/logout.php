<?php

namespace App\Spotlight;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use Illuminate\Contracts\Auth\StatefulGuard;

class logout extends SpotlightCommand
{
    protected string $name = 'Logout';

    protected string $description = 'Logout out of your account';

    public function execute(Spotlight $spotlight, StatefulGuard $guard): void
    {
        $guard->logout();
        $spotlight->redirectRoute('/');
    }

    public function shouldBeShown(): bool
    {
        return auth()->check();
    }
}
