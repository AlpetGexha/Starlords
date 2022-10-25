<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Artesaos\SEOTools\Facades\{SEOMeta, OpenGraph, TwitterCard, JsonLd};
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Blog | Admin');
        return view('admin.Blog.Blog');
    }

    public function show(string $slug, Request $r)
    {
        $blog = Blog::where('slug', $slug)
            ->with('user:id,username,name', 'media', 'tags')
            ->firstOrFail();

        $this->singleBlogSEO($blog);

        if (RateLimiter::remaining($r->ip() . $blog->id, 1)) {
            RateLimiter::hit($r->ip() . $blog->id);
            $blog->views++;
            $blog->save();
        }
        $blog->visit()->hourlyIntervals()->withIp();

        return view('blog.single', compact('blog'));
    }

    public function create()
    {
        SEOMeta::setTitle('Create Blog | Admin');
        return view('admin.Blog.create');
    }

    public function singleBlogSEO($blog)
    {
        SEOTools::setTitle($blog->title);
        SEOTools::opengraph()->addProperty('type', 'blog');
        SEOTools::opengraph()->addImage($blog->getMedia('blog')->first() ? $blog->getMedia('blog')->first()->getUrl() : config('app.no_file'));
        SEOTools::setDescription($blog->body);
        SEOTools::setDescription($blog->body);
        SEOTools::opengraph()->setTitle($blog->title)
            ->setDescription($blog->body)
            ->setType('article')
            ->setArticle([
                'published_time' => $blog->created_at->toW3CString(),
                'modified_time' => $blog->updated_at->toW3CString(),
                'author' => $blog->user->username(),
            ]);
    }
}
