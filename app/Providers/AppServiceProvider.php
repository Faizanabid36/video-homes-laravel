<?php

namespace App\Providers;

use App\Page;
use App\UserCategory;
use App\UserRole;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use function foo\func;

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
            $industries           = UserRole::where( 'role', '!=', 'admin' )->get();
            $user_parent_category = UserCategory::whereNull( 'parent_id' )->get();
            $roles_assoc          = $user_parent_category->groupBy( 'role_id' );

            $user_child_category  = $user_parent_category->groupBy( 'parent_id' );


            View::share(
                'user_parent_category', $user_parent_category
            );
            View::share(
                'user_child_category', $user_child_category
            );
            View::share( 'roles', $industries );
            View::share(
                'roles_assoc', $roles_assoc
            );

            view::composer( 'directory.cat_directory', function ( $view ) use ( $industries ) {
                $view->with( compact( 'industries' ) );
            } );


            View::composer( 'layouts.public.app', function ( $view ) {
                $pages = Page::whereIsPublic( 1 )->get();
                $view->with( compact('pages') );
            } );
        }
    }
}
