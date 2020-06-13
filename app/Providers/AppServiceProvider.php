<?php

namespace App\Providers;

use App\UserCategory;
use App\UserTags;
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
        //
        Schema::defaultStringLength(191);
        $user_parent_category=UserCategory::whereNull('parent_id')->get();
        $user_child_category=UserCategory::whereNotNull('parent_id')->get()->groupBy('parent_id');

//      /**/  dd($user_child_category);

//        $user_tags=UserTags::all();
        View::share(
            'user_parent_category', $user_parent_category
        );
        View::share(
            'user_child_category', $user_child_category
        );
    }
}
