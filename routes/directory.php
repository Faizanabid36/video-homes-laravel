<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'MainController@index')->name('home');
//
//Route::get('/joe', 'MainController@joe')->name('joe');
//Route::get('account_types','MainController@account_types')->name('account_types');
Route::get('/directory/{level1?}/{level2?}', 'MainController@directory1')->name('directory');
Route::get('/u/{username}/{video_id?}','MainController@directory_by_user_video')->name('directory_by_username');



