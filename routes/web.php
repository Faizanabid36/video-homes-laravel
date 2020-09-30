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


Auth::routes();
//Auth User
Route::group( [ 'middleware' => 'auth' ], function () {
    Route::get('logged_in_user','HomeController@logged_in_user');
    Route::view( '/dashboard', 'dashboard' )->name( 'dashboard' );
    Route::resource( 'playlist', 'PlaylistController' );
    Route::resource('profile','ProfileController');
//Video
    Route::get( '/all_videos', 'VideoController@list_of_videos' );
    Route::get( '/all_videos/{order}', 'VideoController@list_of_videos_by_order' );
    Route::post( 'delete_video', 'VideoController@delete_video' );
    Route::post( '/upload-video', 'VideoController@upload_video' );
    Route::put( '/update-video/{video}', 'VideoController@update_video' );
    Route::get( 'edit_video/{video_id}', 'VideoController@edit_video' );
//    Route::get( 'video_is_played/{id}', 'HomeController@video_is_played' )->name( 'video_is_played' );

    //Dashboard
    Route::post( '/dashboard_statistics', 'DashboardController@dashboard_type' )->name( 'dashboard_type' );
    //Analytics
    Route::post( '/get_all_statistics', 'DashboardController@get_all_statistics' );




    //Profile
    Route::get( 'get_logged_user', 'HomeController@logged_user' );
    Route::put( 'edit_user_profile/{user}', 'HomeController@edit_user_profile' );
    Route::post( 'update_profile', 'HomeController@update_profile' );
    Route::post( 'change_password', 'HomeController@change_password' );
    Route::delete( 'delete_user_profile/{user}', 'HomeController@delete_user_profile' );
    Route::get( 'image-upload', 'ImageUploadController@imageUpload' )->name( 'image.upload' );
    Route::post( 'image-upload', 'ImageUploadController@imageUploadPost' );
    Route::post( 'update_company_logo', 'ImageUploadController@update_company_logo' );


//    Route::post( 'search_to_block_user', 'HomeController@search_to_block_user' );
//    Route::post( 'user_settings', 'HomeController@block_user' );
    //User Images


//    Route::get( 'all_playlists', 'HomeController@get_playlist' );
//    Route::post( 'delete_playlist', 'HomeController@delete_playlist' );
//    Route::post( 'update_playlist', 'HomeController@update_playlist' );
    Route::get( 'videos_likes', 'HomeController@update_likes' );
    Route::get( 'videos_dislikes', 'HomeController@update_dislikes' );
    Route::post( 'post_comment', 'CommentsController@store' )->name( 'post_comment' );
    Route::post( 'delete_comment', 'CommentsController@destroy' )->name( 'delete_comment' );
    Route::get( 'get_total_comments', 'CommentsController@countTotalComments' );
    Route::post( 'createVideoAction', 'VideoController@createVideoAction' )->name( 'createVideoAction' );
    Route::get( '/categories', 'CategoryController@index' );

    Route::post('/to_user','UserMessageController@store')->name('to_user');
} );

Route::group( [ 'middleware' => 'admin' ], function () {
    Route::prefix( 'admin' )->group( function () {
        Route::view( '/', 'admin.home' )->name( 'admin_panel' );
        Route::resource( 'categories', 'Admin\\CategoriesController' );
        Route::resource( 'pages', 'Admin\\PagesController' );
        Route::resource( 'user-categories', 'Admin\\UserCategoriesController' );
        Route::resource( 'videos', 'Admin\\VideosController' );
        Route::resource( 'users', 'Admin\\UsersController' );
        Route::resource( 'settings', 'Admin\\SettingsController' );
        Route::view( 'profile', 'admin.users.profile' )->name( 'admin.profile' );
        Route::resource( 'user_message', 'UserMessageController' );
        Route::get( 'reported_query_videos', 'UserMessageController@reported_videos' )->name( 'reported_query_videos' );

    } );
} );


//Home
Route::get( '/', 'MainController@index' )->name( 'home' );
//Directory
Route::get( '/directory/{level1?}/{level2?}', 'MainController@directory' )->name( 'directory' );
///Embed Videos
Route::get( '/embed/{video_id}', 'MainController@embed' )->name( 'embed_video' );
//Play Video Analytics
Route::put( 'is_play/{video}', 'MainController@isplay' )->name( 'is_played' );

//Pages
Route::get( '/{slug}/{video_id?}', 'MainController@page_or_username' )->middleware(\App\Http\Middleware\IsUserNameMiddleware::class)->name( 'directory_by_username' );
//Route::get( '/{slug}', 'MainController@page' )->middleware(\App\Http\Middleware\IsPageMiddleware::class)->name( 'pages' );









