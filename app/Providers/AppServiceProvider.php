<?php

namespace App\Providers;

use App\Page;
use App\Settings;
use App\UserCategory;
use App\UserRole;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        Schema::defaultStringLength(191);
        if (! $this->app->runningInConsole()) {

            View::composer( 'layouts.public.app', function ( $view ) {
                $pages = Page::whereIsPublic( 1 )->whereInNav(1)->get();
                $footer = Settings::first()->footer;
                $view->with( compact('pages','footer') );
            } );
        }
    }
}
