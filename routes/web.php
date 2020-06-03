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


//Public Pages
Route::get('/', 'MainController@index')->name('home');
Route::get('/embed/{video_id}', 'VideoController@get_embedded_video')->name('embed_video');
Route::get('{username}/watch_video', 'VideoController@watch_video');
Route::get('{username}/watch_video/is_watchable', 'VideoController@watchable_video');
Route::post('{username}/', 'VideoController@watch_video');
Route::get('/categories', 'CategoryController@index');
Auth::routes();

//Auth User
Route::group(['middleware' => 'auth'], function () {
    Route::get('admin_panel', 'AdminController@index')->name('admin_panel');
    Route::get('videos_for_approval', 'AdminController@videos_for_approval')->name('videos_for_approval');
    Route::get('approve_video/{id}', 'AdminController@approve_video')->name('approve_video');
    Route::get('category', 'AdminController@category')->name('category');
    Route::get('delete_category/{id}', 'AdminController@delete_category');
    Route::get('edit_category/{id}', 'AdminController@edit_category');
    Route::post('update_category', 'AdminController@update_category');
    Route::get('add_category', function () {
        return view('admin.add_category');
    })->name('add_category');
    Route::post('store_category', 'AdminController@store_category');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::post('/dashboard_statistics', 'DashboardController@dashboard_type')->name('dashboard_type');
    Route::post('/get_all_statistics','DashboardController@get_all_statistics');
    Route::get('video_is_played/{id}','HomeController@video_is_played')->name('video_is_played');
    Route::post('/upload-video', 'VideoController@upload_video');
    Route::put('/update-video/{video}', 'VideoController@update_video');
    Route::get('/all_videos', 'VideoController@list_of_videos');
    Route::get('/all_videos/{order}', 'VideoController@list_of_videos_by_order');
    Route::get('edit_video/{video_id}', 'VideoController@edit_video');

    Route::resource('playlist', 'PlaylistController');
    Route::get('get_logged_user', 'HomeController@logged_user');
    Route::post('edit_user_profile', 'HomeController@edit_user_profile');
    Route::post('search_to_block_user', 'HomeController@search_to_block_user');
    Route::post('user_settings', 'HomeController@block_user');

    Route::get('all_playlists', 'HomeController@get_playlist');
    Route::post('delete_playlist', 'HomeController@delete_playlist');
    Route::post('update_playlist', 'HomeController@update_playlist');
    Route::get('videos_likes', 'HomeController@update_likes');
    Route::get('videos_dislikes', 'HomeController@update_dislikes');
    Route::post('post_comment', 'CommentsController@store')->name('post_comment');
    Route::post('delete_comment', 'CommentsController@destroy')->name('delete_comment');
    Route::get('get_total_comments', 'CommentsController@countTotalComments');
    Route::post('createVideoAction', 'VideoController@createVideoAction')->name('createVideoAction');

});

