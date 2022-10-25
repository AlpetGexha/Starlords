<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Strict Model
        // Model::preventLazyLoading(!$this->app->isProduction());
        // Model::preventSilentlyDiscardingAttributes(!$this->app->isProduction());
        // Model::preventAccessingMissingAttributes(!$this->app->isProduction());

        //
        Str::macro('getDate', function ($date) {
            return \Carbon\Carbon::parse($date)->isoFormat('MMMM Do, YYYY');
        });

        Str::macro('getFullDate', function ($date) {
            return \Carbon\Carbon::parse($date)->isoFormat('Do MMMM YYYY, h:mm:ss a');
        });

        Str::macro('getDateWithoutYear', function ($date) {
            return \Carbon\Carbon::parse($date)->isoFormat('Do MMMM, h:mm:ss a');
        });

        Str::macro('readTime', function (...$text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);

            return (int)max(1, $minutesToRead);
        });

        Str::macro('removeFirstLast', function ($text) {
            return substr($text, 1, -1);
        });

        Str::macro('removeFirst', function ($text) {
            return substr($text, 1);
        });

        Str::macro('removeLast', function ($text) {
            return substr($text, 0, -1);
        });

        Str::macro('addFirst', function ($text, $char) {
            return $char . $text;
        });

        Str::macro('addLast', function ($text, $char) {
            return $text . $char;
        });

        Str::macro('addFirstLast', function ($text, $char) {
            return $char . $text . $char;
        });

        Str::macro('removeHTML', function (...$text) {
            return strip_tags(implode(" ", $text));
        });
    }
}
