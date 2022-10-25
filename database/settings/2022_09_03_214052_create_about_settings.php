<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateAboutSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('about.welcome', 'Nice to meet you, we’re StarLords.');
        $this->migrator->add('about.aboutus', 'We exist because we care about people. We believe in a future where experiences are the new stage for people to meet, connect, be inspired, and learn from one another. That\'s why we have created a team that is comprised of artists, musicians, and dreamers just like you. We understand creating great experiences is no easy feat, which is why it\'s our mission to deliver event technology that transforms the way you host events.');
        $this->migrator->add('about.words', 'believe in a future where experiences are the');
        $this->migrator->add('about.words_body', 'new stage for people to meet, connect, be inspired, and learn from one another.');
        $this->migrator->add('about.team', '');
        $this->migrator->add('about.team_body', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi fugiat nisi placeat tempore deleniti, pariatur velit, atque, asperiores aliquam reprehenderit voluptatum. Cum possimus voluptas non? Dolor ipsum sequi quisquam libero.');
        $this->migrator->add('about.event', 'Join our community of 10k+ organizers who trust their events to Starloards. Get started today.');
    }
}
