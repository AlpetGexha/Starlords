<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateHomeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('home.home_words', 'Find Your Unforgettable Events');
    }
}
