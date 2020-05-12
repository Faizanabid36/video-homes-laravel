<?php

use App\Comment;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/dashboard/{type}', 'DashboardController@dashboard_type')->name('dashboard_type');
    Route::post('/upload-video', 'VideoController@upload_video');
    Route::put('/update-video/{video}', 'VideoController@update_video');
    Route::get('/all_videos', 'VideoController@list_of_videos');
    Route::get('edit_video/{video_id}', 'VideoController@edit_video');

    Route::resource('playlist', 'PlaylistController');
//    Route::resource('playlist','PlaylistController');
    Route::get('get_logged_user', 'HomeController@logged_user');
    Route::post('edit_user_profile', 'HomeController@edit_user_profile');
    Route::post('search_to_block_user', 'HomeController@search_to_block_user');
    Route::post('user_settings', 'HomeController@block_user');

    Route::get('all_playlists', 'HomeController@get_playlist');
    Route::post('delete_playlist', 'HomeController@delete_playlist');
    Route::post('update_playlist','HomeController@update_playlist');
    Route::get('videos_likes','HomeController@update_likes');
    Route::get('videos_dislikes','HomeController@update_dislikes');
    Route::post('post_comment','CommentsController@store')->name('post_comment');
    Route::post('delete_comment','CommentsController@destroy')->name('delete_comment');
    Route::get('get_total_comments','CommentsController@countTotalComments');

});
Route::get('/embed/{video_id}','VideoController@get_embedded_video')->name('embed_video');
Route::get('{username}/watch_video', 'VideoController@watch_video');
Route::get('{username}/watch_video/is_watchable', 'VideoController@watchable_video');
Route::post('{username}/', 'VideoController@watch_video');
Route::get('/categories', 'CategoryController@index');
