<?php

use App\Page;
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
    $trail->push('Directory', route('directory', $level1));
    if($level1){
        $trail->push(\App\UserCategory::whereSlug($level1)->first()->name, route('directory', $level1));
    }
    if($level2){
        $trail->push(\App\UserCategory::whereSlug($level2)->first()->name, route('directory', $level2));
    }
});
