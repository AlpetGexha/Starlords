<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $footer_text;
    public string $phone;
    public string $email;
    public string $footer_newsletter_text;
    public string $facebook;
    public string $twitter;
    public string $instagram;
    public string $linkedin;
    public string $youtube;
    public string $github;


    public static function group(): string
    {
        return 'general';
    }
}
