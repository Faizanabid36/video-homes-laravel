<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
//Route::view('/{path?}', 'container');
Route::group( [ 'middleware' => 'auth' ], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/dashboard/{type}', 'DashboardController@dashboard_type')->name('dashboard_type');
//    Route::view('/upload-video', 'container')->name('upload-video');
    Route::post('/upload-video', 'VideoController@upload_video');
    Route::post('/update-video/{video_id}', 'VideoController@update_video');
//    Route::view('/watch', 'container');
    Route::post('{username}/', 'VideoController@watch_video');
    Route::get('watch_video', 'VideoController@watch_video');
    Route::get('/all_videos', 'VideoController@list_of_videos');
//    Route::view('/watch_videos', 'container')->name('watch');
} );
