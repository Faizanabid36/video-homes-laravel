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
    Route::view( '/dashboard', 'dashboard' )->name( 'dashboard' );
    Route::post( 'delete_video', 'VideoController@delete_video' );

    Route::post( '/dashboard_statistics', 'DashboardController@dashboard_type' )->name( 'dashboard_type' );
    Route::post( '/get_all_statistics', 'DashboardController@get_all_statistics' );
    Route::get( 'video_is_played/{id}', 'HomeController@video_is_played' )->name( 'video_is_played' );
    Route::post( '/upload-video', 'VideoController@upload_video' );
    Route::put( '/update-video/{video}', 'VideoController@update_video' );
    Route::get( '/all_videos', 'VideoController@list_of_videos' );
    Route::get( '/all_videos/{order}', 'VideoController@list_of_videos_by_order' );
    Route::get( 'edit_video/{video_id}', 'VideoController@edit_video' );

    Route::resource( 'playlist', 'PlaylistController' );
    Route::get( 'get_logged_user', 'HomeController@logged_user' );
//    Route::post( 'edit_user_profile', 'HomeController@edit_user_profile1' );
    Route::put( 'edit_user_profile/{user}', 'HomeController@edit_user_profile' );
    Route::post( 'search_to_block_user', 'HomeController@search_to_block_user' );
    Route::post( 'user_settings', 'HomeController@block_user' );
    //User Images
    Route::get( 'image-upload', 'ImageUploadController@imageUpload' )->name( 'image.upload' );
    Route::post( 'image-upload', 'ImageUploadController@imageUploadPost' );
    Route::post( 'update_company_logo', 'ImageUploadController@update_company_logo' );

    Route::get( 'all_playlists', 'HomeController@get_playlist' );
    Route::post( 'delete_playlist', 'HomeController@delete_playlist' );
    Route::post( 'update_playlist', 'HomeController@update_playlist' );
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
////        Route::resource( 'public_pages', 'PageController' );
//        Route::get( 'create_user_categories', 'AdminController@create_user_categories' )->name( 'create_user_categories' );
////        Route::post( 'add_user_category', 'AdminController@add_user_category' )->name( 'add_user_category' );
////        Route::get( 'all_user_categories', 'AdminController@all_user_categories' )->name( 'all_user_categories' );
////        Route::get( 'edit_user_category/{id}', 'AdminController@edit_user_category' )->name( 'edit_user_category' );
////        Route::post( 'update_user_category', 'AdminController@update_user_category' )->name( 'update_user_category' );
////        Route::get( 'delete_user_category/{id}', 'AdminController@delete_user_category' )->name( 'delete_user_category' );
//        Route::get( 'videos_list', 'AdminController@videos_list' )->name( 'admin.videos_list' );
//        Route::get( 'admin_delete_video/{id}', 'AdminController@delete_video' )->name( 'admin.delete_video' );
//        Route::get( 'users_list', 'AdminController@users_list' )->name( 'users_list' );
//
//
//        Route::get( 'videos_for_approval', 'AdminController@videos_for_approval' )->name( 'videos_for_approval' );
//        Route::get( 'review_video/{id}', 'AdminController@review_video' )->name( 'review_video' );
//        Route::get( 'approve_video/{id}', 'AdminController@approve_video' )->name( 'approve_video' );
//        Route::get( 'decline_video/{id}', 'AdminController@decline_video' )->name( 'decline_video' );
////        Route::get( 'category', 'AdminController@category' )->name( 'category' );
////        Route::get( 'delete_category/{id}', 'AdminController@delete_category' );
////        Route::get( 'edit_category/{id}', 'AdminController@edit_category' );
////        Route::post( 'update_category', 'AdminController@update_category' );
////        Route::get( 'add_category', function () {
////            return view( 'admin.add_category' );
////        } )->name( 'add_category' );
////        Route::post( 'store_category', 'AdminController@store_category' );
////        Route::get( 'user_tags', 'AdminController@list_user_tags' )->name( 'user_tags' );
////        Route::get( 'edit_user_tag/{id}', 'AdminController@edit_tag' )->name( 'edit_tag' );
////        Route::post( 'update_user_tag/{id}', 'AdminController@update_tag' )->name( 'update_tag' );
////        Route::get( 'delete_user_tag/{id}', 'AdminController@delete_tag' )->name( 'delete_tag' );
////        Route::get( 'add_tag', function () {
////            return view( 'admin.add_tag' );
////        } )->name( 'add_tag' );
////        Route::post( 'store_tag', 'AdminController@store_tag' )->name( 'store_tag' );
//
//
//        Route::get( 'user', 'AdminController@users' )->name( 'admin.list_user' );
//        Route::get( 'delete_user/{id}', 'AdminController@delete_user' )->name( 'admin.delete_user' );
//        Route::get( 'deactivate_user/{id}', 'AdminController@deactivate_user' )->name( 'admin.deactivate_user' );
    } );
} );

//Route::resource( 'report_query', 'ReportQueryController' );

//


//Route::post( '/search_in_directory', 'MainController@search_in_directory' )->name( 'search_in_directory' );

//Route::get( '{username}/watch_video', 'VideoController@watch_video' );
//Route::get( '{username}/watch_video/is_watchable', 'VideoController@watchable_video' );
//Route::post( '{username}/', 'VideoController@watch_video' );
//

//Home
Route::get('{slug}',function($slug){
    $page = \App\ReservedSlug::whereSlug($slug)->firstOrFail();
    return route($page->name);
});
Route::get( '/', 'MainController@index' )->name( 'home' );

//Pages
Route::get( '/page/{slug}', 'MainController@page' )->name( 'public.page' );

//Directory
Route::get( '/directory/{level1?}/{level2?}', 'MainController@directory' )->name( 'directory' );
Route::get( '/u/{username}/{video_id?}', 'MainController@directory_by_username' )->name( 'directory_by_username' );

///Embed Videos
Route::get( '/embed/{video_id}', 'MainController@embed_video' )->name( 'embed_video' );

//Video
Route::put( 'is_play/{video}', 'MainController@is_played' )->name( 'is_played' );


Route::resource( 'admin/users', 'Admin\\UsersController' );
