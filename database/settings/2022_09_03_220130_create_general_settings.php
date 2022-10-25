<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.footer_text', '© 2022 Starlords, Inc. All rights reserved.');
        $this->migrator->add('general.footer_newsletter_text', 'The latest news, articles, and resources,');
        $this->migrator->add('general.facebook', '#');
        $this->migrator->add('general.phone', '+383 44 567 631');
        $this->migrator->add('general.email', 'agexha@gmail.com');
        $this->migrator->add('general.twitter', '#');
        $this->migrator->add('general.instagram', '#');
        $this->migrator->add('general.linkedin', 'https://www.linkedin.com/in/alpet-gexha-499b071a3/');
        $this->migrator->add('general.youtube', '#');
        $this->migrator->add('general.github', 'https://www.github.com/AlpetGexh');
    }
}
