<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomeSettings extends Settings
{
    public string $home_words;

    public static function group(): string
    {
        return 'home';
    }
}
