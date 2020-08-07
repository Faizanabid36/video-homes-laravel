<?php

use App\Page;
use \App\UserCategory;
use App\Video;
use \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('public.page', function ($trail,$slug) {
    $page=Page::viewPage($slug)->firstOrFail();
    $trail->parent('home');
    $trail->push($page->title, route('public.page',$slug));
});

// Home > Blog > [Category]
Breadcrumbs::for('directory', function ($trail, $level1 = null,$level2 = null) {
    $trail->parent('home');
    $trail->push('Directory', route('directory'));
    if($level1){
        $trail->push(UserCategory::whereSlug($level1)->first()->name, route('directory', $level1));
    }
    if($level2){
        $trail->push(UserCategory::whereSlug($level2)->first()->name, route('directory', $level2));
    }
});

Breadcrumbs::for('directory_by_username', function ($trail, $username,$video_id = null) {
    $trail->parent('home');
    $trail->push('Directory', route('directory'));
    $video = Video::userVideos( $username, $video_id )->firstOrFail();
    $category = UserCategory::find($video->user_extra->user_category_id);
    $level1 = $category;
    $level2 = false;
    if($category->parent_id){
        $level2 = $level1;
        $level1 = UserCategory::find($category->parent_id);
    }
    if($level1){
        $trail->push($level1->name, route('directory', $level1->slug));
    }
    if($level2){
        $trail->push($level2->name, route('directory', $level2->slug));
    }
    $trail->push($video->user_extra->user_id->name, route('directory_by_username',$username));
    if($video_id){
        $trail->push($video->title, route('directory_by_username',$username,$video_id));
    }
});
