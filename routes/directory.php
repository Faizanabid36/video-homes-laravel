<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'MainController@index')->name('home');
Route::get('/directory/{level1?}/{level2?}', 'MainController@directory')->name('directory');
Route::get('/u/{username}/{video_id?}','MainController@directory_by_username')->name('directory_by_username');



