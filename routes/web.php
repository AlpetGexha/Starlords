<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HealthCheckResultsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['controller' => HomeController::class], function () {
    Route::get('/', 'index')->name('homepage');
    Route::get('/aboutus', 'aboutus')->name('aboutus');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/blog', 'blog')->name('blog');
});

// Blog
Route::group(['prefix' => 'blog', 'as' => 'blog.', 'controller' => BlogController::class], function () {
    Route::get('/{blog:slug}', 'show')->name('single');
});

// Events
Route::group(['controller' => EventController::class, 'as' => 'event.'], function () {
    Route::get('/events/show/all{search?}', 'index')->name('show');
    Route::get('/events/{event:slug}', 'show')->name('single');
    Route::get('/event/create', 'create')->name('create')->middleware('auth');
    Route::get('/user/myticket', 'myticket')->name('myticket')->middleware('auth');
});

// Profile
Route::group(['controller' => ProfileController::class, 'as' => 'profile.'], function () {
    Route::get('/profile/{profile:slug}', 'show')->name('single');
    Route::get('/profile/{profile:slug}/album', 'album')->name('album.show');
    Route::get('/profile/organization/create', 'create')->name('create')->middleware(['auth']);
    Route::get('/profile/organization/{profile:slug}/edit', 'edit')->name('edit')->middleware(['auth']);
    Route::get('/u/{username}', 'user')->name('user.single');
    Route::get('/profile/show/all', 'index')->name('all');
    Route::get('/profile/show/organization', 'organization')->name('organization')->middleware(['auth']);
});

Route::get('/testing/email', function () {
    $user = ['username' => 'test',];
    return view('mail.user-register', compact('user'));
});


$admin_subdomain = str_replace('://', '://' . 'admin.', config('app.url'));
// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'auth:sanctum'], 'controller' => AdminController::class], function () {
    Route::get('/show/User', 'user')->name('user')->middleware('can:user_show');
    Route::get('/show/profile', 'profile')->name('profile')->middleware('auth');

    Route::get('/show/Role', 'role')->name('role')->middleware('can:user_make_role');
    Route::get('/show/Role/create', 'createRole')->name('role.create')->middleware('can:user_make_role');

    Route::get('/show/Contact', 'contact')->name('contact.show')->middleware('can:contact_access');
    Route::get('/show/Feedback', 'feedback')->name('feedback.show')->middleware('can:admin_show');

    Route::get('/show/EventCategory', [EventCategoryController::class, 'index'])->name('category.show')->middleware('can:category_access');
    Route::get('/show/EventCategory/create', [EventCategoryController::class, 'create'])->name('catgory.create')->middleware('can:category_access');

    Route::get('/show/TeamMember', [TeamMemberController::class, 'index'])->name('team.show')->middleware('can:team_access');
    Route::get('/show/TeamMember/create', [TeamMemberController::class, 'create'])->name('team.create')->middleware('can:team_create');

    Route::get('/show/Blog', [BlogController::class, 'index'])->name('blog.show')->middleware('can:blog_access');
    Route::get('/show/Blog/Create', [BlogController::class, 'create'])->name('blog.create')->middleware('can:blog_access');

    Route::get('/settings', 'settings')->name('settings')->middleware(['can:settings_access']);
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware(['can:admin_show']);

    Route::get('/audit', 'audit')->name('audit')->middleware(['can:audits_show']);
    Route::get('/report', 'report')->name('report')->middleware('auth');

    Route::get('/sponzor', 'sponzor')->name('sponzor')->middleware('auth');
    Route::get('/sponzor/create', 'sponzorCreate')->name('sponzor.create')->middleware('auth');

    Route::get('/health', HealthCheckResultsController::class)->name('health')->middleware(['can:admin_show']);
    Route::get('/backup', 'backup')->name('backup')->middleware(['can:admin_show']);
});

Route::post('/admin/dashboard', function () {
    return to_route('home');
})->name('dashboard');

// Socialite
Route::group(['controller' => SocialiteController::class], function () {
    Route::get('/auth/{provaider}', 'redirectToProvider')->name('auth.provider');
    Route::get('/auth/{provaider}/callback', 'handleProviderCallback')->name('auth.callback');
});

// Stripe
Route::group(['controller' => StripeController::class], function () {
    Route::get('payment-form', 'form')->name('form.payment');
    Route::post('make/payment', 'makePayment')->name('make.payment');
});

// Newletter Verify
Route::get('/verify/subscription/{token}', NewsletterController::class)->name('check.subscription');
