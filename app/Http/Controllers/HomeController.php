<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Sponzor;
use App\Models\TeamMember;
use App\Settings\AboutUsSettings;
use App\Settings\GeneralSettings;
use App\Settings\HomeSettings;
use Artesaos\SEOTools\Facades\{SEOMeta, OpenGraph, TwitterCard, JsonLd};
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(HomeSettings $setting)
    {
        $this->homeSEO();

        $ez = Collection::make([
            collect(['url_image' => 'https://laravel.com/img/logomark.min.svg', 'url' => 'https://laravel.com/', 'name' => 'Laravel']),
            collect(['url_image' => 'https://res.cloudinary.com/astrava/image/upload/f_auto/v1589834066/alpinetoolbox/placeholder_k1nruc.png', 'url' => 'https://alpinejs.dev/', 'name' => 'AlpineJs']),
            collect(['url_image' => 'https://laravel-livewire.com/img/twitter.png', 'url' => 'https://laravel-livewire.com/', 'name' => 'Livewire']),
            collect(['url_image' => 'https://laravelnews.imgix.net/laravel-news__logo.png?ixlib=php-3.3.0', 'url' => 'https://laravel-news.com/', 'name' => 'Laravel News']),

            collect(['url_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png', 'url' => 'https://vuejs.org/', 'name' => 'Vue.js']),
            collect(['url_image' => 'https://vitejs.dev/logo-with-shadow.png', 'url' => 'https://vitejs.dev/', 'name' => 'Vite']),
            collect(['url_image' => '', 'url' => 'https://laracasts.com/', 'name' => 'Laracasts']),
            collect(['url_image' => 'https://yt3.ggpht.com/afhnENJ2I2SGbg1tew5YFbR4-ZfZnpuDNXDwnidgrQOCyvSgCv_78eOEXsVvkdx--NjeGqMwLfc=s900-c-k-c0x00ffffff-no-rj', 'url' => 'https://laracon.net/', 'name' => 'Laracon']),
        ]);

        // dd($ez);

        $events = Event::with(['user:id,name,username', 'category', 'media'])->limit(4)->get();
        $categorys = EventCategory::limit(15)->get();


        $sponzors = Sponzor::orderBy('id', 'asc')->get();

        return view('home', compact('events', 'categorys', 'setting', 'sponzors'));
    }

    public function aboutus(AboutUsSettings $s)
    {
        $this->aboutusSEO();
        $tickets_count = DB::table('tickets')->sum('quantity');
        $organizer_count = DB::table('profiles')->count('id');

        return view('aboutus', compact('s', 'tickets_count', 'organizer_count'));
    }

    public function contact(GeneralSettings $setting)
    {
        return view('contact', compact('setting'));
    }

    public function blog()
    {
        $this->blogSEO();
        $blogs = Blog::with('user:id,username,name', 'media')
            ->orderByDesc('id')
            ->fastPaginate(12);
        return view('blog.blog', compact('blogs'));
    }


    public function homeSEO()
    {
        SEOTools::setTitle('Home');
    }

    public function aboutusSEO()
    {
        SEOTools::setTitle('About Us');
        SEOTools::opengraph()->addProperty('type', 'aboutus');
        $images = TeamMember::with('media')->get();
        foreach ($images as $image) {
            SEOTools::opengraph()->addImage($image->getMedia('team')->first() ? $image->getMedia('team')->first()->getUrl() : config('app.no_file'));
        }
    }

    public function blogSEO()
    {
        SEOTools::setTitle('Blog');
        SEOTools::opengraph()->addProperty('type', 'blog');
    }
}
