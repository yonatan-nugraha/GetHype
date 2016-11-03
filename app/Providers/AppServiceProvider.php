<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\User;
use App\Event;
use App\Category;
use App\EventType;
use App\Collection;
use App\Journal;
use App\Banner;

use Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::saving(function ($event) {
            Cache::forget('events');
        });

        Category::saving(function ($category) {
            Cache::forget('categories');
        });

        EventType::saving(function ($event_type) {
            Cache::forget('event_types');
        });

        Collection::saving(function ($collection) {
            Cache::forget('collections');
        });

        Journal::saving(function ($journal) {
            Cache::forget('journals');
        });

        Banner::saving(function ($banner) {
            Cache::forget('carousel_banners');
            Cache::forget('small_banners');
            Cache::forget('carousel_banners_search');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
