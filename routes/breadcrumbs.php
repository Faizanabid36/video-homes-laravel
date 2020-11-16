<?php

use App\Page;
use \App\UserCategory;
use App\Video;
use \App\User;
use \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//// Home
//Breadcrumbs::for( 'home', function ( $trail ) {
//    $trail->push( 'Home', route( 'home' ) );
//} );

Breadcrumbs::for('public.page', function ($trail, $slug) {
//    $trail->parent( 'home' );
    $trail->push(Page::viewPage($slug)->first()->title, route('public.page', $slug));
});

// Home > Blog > [Category]
Breadcrumbs::for('directory', function ($trail, $level1 = null, $level2 = null) {
//    $trail->parent( 'home' );
    $trail->push('Directory', route('directory'));
    if ($level1) {
        dd(UserCategory::whereSlug($level1)->first());
        $trail->push(!is_null(UserCategory::whereSlug($level1)->first()->name)
            ? UserCategory::whereSlug($level1)->first()->name : '',
            route('directory', $level1));
    }
    if ($level2) {
        $trail->push(!is_null(UserCategory::whereSlug($level2)->first()->name)
            ?UserCategory::whereSlug($level2)->first()->name:'',
            route('directory', [$level1, $level2]));
    }
});

Breadcrumbs::for('directory_by_username', function ($trail, $slug, $video_id = null) {
//    $trail->parent( 'home' );
    if (Page::viewPage($slug)->count() > 0) {
        $trail->push(Page::viewPage($slug)->first()->title, route('directory_by_username', $slug));

        return;
    }
    $trail->push('Directory', route('directory'));

    $video = Video::userVideos($slug, $video_id)->first();
    $user = User::whereUsername($slug)->first();
    $category = UserCategory::find($user->user_extra->user_category_id);
    $level1 = $category;
    if ($category->parent_id) {
        $level1 = UserCategory::find($category->parent_id);
        $level2 = $category;
        $trail->push($level1->name, route('directory', $level1->slug));
        $trail->push($level2->name, route('directory', [$level1->slug, $level2->slug]));
    } else {
        $trail->push($level1->name, route('directory', $level1->slug));
    }

    $trail->push($user->name, route('directory_by_username', $slug));
    if ($video) {
        $trail->push($video->title, route('directory_by_username', [$slug, $video_id]));
    }
});
