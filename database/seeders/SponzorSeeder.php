<?php

namespace Database\Seeders;

use App\Models\Sponzor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class SponzorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponzors = Collection::make([
            collect(['url_image' => 'https://laravel.com/img/logomark.min.svg', 'url' => 'https://laravel.com/', 'name' => 'Laravel']),
            collect(['url_image' => 'https://res.cloudinary.com/astrava/image/upload/f_auto/v1589834066/alpinetoolbox/placeholder_k1nruc.png', 'url' => 'https://alpinejs.dev/', 'name' => 'AlpineJs']),
            collect(['url_image' => 'https://laravel-livewire.com/img/twitter.png', 'url' => 'https://laravel-livewire.com/', 'name' => 'Livewire']),
            collect(['url_image' => 'https://laravelnews.imgix.net/laravel-news__logo.png?ixlib=php-3.3.0', 'url' => 'https://laravel-news.com/', 'name' => 'Laravel News']),

            collect(['url_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png', 'url' => 'https://vuejs.org/', 'name' => 'Vue.js']),
            collect(['url_image' => 'https://vitejs.dev/logo-with-shadow.png', 'url' => 'https://vitejs.dev/', 'name' => 'Vite']),
            collect(['url_image' => 'https://cdn.knoji.com/images/logo/laracasts.jpg?aspect=center&snap=false&width=500&height=250', 'url' => 'https://laracasts.com/', 'name' => 'Laracasts']),
            collect(['url_image' => 'https://yt3.ggpht.com/afhnENJ2I2SGbg1tew5YFbR4-ZfZnpuDNXDwnidgrQOCyvSgCv_78eOEXsVvkdx--NjeGqMwLfc=s900-c-k-c0x00ffffff-no-rj', 'url' => 'https://laracon.net/', 'name' => 'Laracon']),
        ]);

        // Insert sponzors
        $sponzors->each(function ($sponzor) {
            Sponzor::create($sponzor->toArray());
        });
    }
}
