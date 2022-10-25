<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Contact::factory(100)->create();
        \App\Models\User::factory(400)->create();
        \App\Models\EventCategory::factory(6)->create();
        \App\Models\Event::factory(300)->create();
        \App\Models\TeamMember::factory(10)->create();
        \App\Models\Profile::factory(10)->create();
        \App\Models\Album::factory(30)->create();
        \App\Models\Ticket::factory(100)->create();
        \App\Models\Blog::factory(50)->create();

        // make post_category_id for each post
        \App\Models\Event::all()->each(function ($event) {
            $event->category()->attach(
                \App\Models\EventCategory::all()->random(rand('1', '3'))->pluck('id')->toArray()
            );
        });

        $this->call([
            RoleRermissionSeeder::class,
            SponzorSeeder::class,
        ]);
    }
}
