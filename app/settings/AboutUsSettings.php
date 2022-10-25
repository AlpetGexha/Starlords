<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutUsSettings extends Settings
{
    public string $welcome;
    public string $aboutus;
    public string $words;
    public string $words_body;
    public string $team;
    public string $team_body;
    public string $event;

    public static function group(): string
    {
        return 'about';
    }
}
