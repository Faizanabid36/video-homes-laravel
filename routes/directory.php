<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'MainController@index')->name('home');
Route::get('/directory/{level1?}/{level2?}', 'MainController@directory1')->name('directory_level');
//Route::get('/directory', 'MainController@directory')->name('directory');
//Route::get('/directory/{role}','MainController@ex_directory_by_category')->name('ex_directory_by_category');
//Route::get('/directory/{role}/{subrole}','MainController@directory_by_sub_category')->name('directory_by_sub_category');
//Route::get('/directory/{role}/{subrole}/{sub_cat}','MainController@directory_by_sub_category_role')->name('directory_by_sub_category_role');
//Route::get('/directory_list/{username}','MainController@directory_by_username')->name('directory_by_username');
Route::get('/directory_list/{username}/{video_id?}','MainController@directory_by_user_video')->name('directory_by_username');
Route::get('/joe', 'MainController@joe')->name('joe');
Route::get('account_types','MainController@account_types')->name('account_types');



