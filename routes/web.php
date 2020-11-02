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

//Route::get('used_space',function (){
//    return auth()->user()->videos->sum('size');
//});


Auth::routes();
// Auth User
Route::group(
	array( 'middleware' => 'auth' ),
	function () {
        // Dashboard Page



        Route::post('to_user', 'UserMessageController@store')->name('to_user');
        Route::post('my_messages', 'UserMessageController@my_messages');
        Route::get('my_messages_list', 'UserMessageController@my_messages_list');
        Route::post('send_message', 'UserMessageController@send_message');
//        Route::get('read_message/{id}', 'UserMessageController@read_message');

        Route::post('update_video_global_settings', 'ProfileController@update_video_global_settings')->name('update_video_global_settings');

        Route::view('/dashboard', 'dashboard')->name('dashboard');

        Route::get('logged_in_user', 'HomeController@logged_in_user');
        // Playlist Pages
        Route::resource('playlist', 'PlaylistController');
        // Profile Pages
        Route::resource('profile', 'ProfileController');

        Route::resource('video', 'VideosController');
        Route::post('video_with_views', 'VideosController@video_with_views');
        Route::post('video_chart_data', 'DashboardController@single_video_statistics');
        // Video
        // Route::get( '/all_videos', 'VideoController@list_of_videos' );
        // Route::get( '/all_videos/{order}', 'VideoController@list_of_videos_by_order' );
        // Route::post( 'delete_video', 'VideoController@delete_video' );
        // Route::post( '/upload-video', 'VideoController@upload_video' );
        // Route::put( '/update-video/{video}', 'VideoController@update_video' );
        // Route::get( 'edit_video/{video_id}', 'VideoController@edit_video' );
        // Route::get( 'video_is_played/{id}', 'HomeController@video_is_played' )->name( 'video_is_played' );

        // Dashboard
		Route::post( '/dashboard_statistics', 'DashboardController@dashboard_type' )->name( 'dashboard_type' );
		// Analytics
		Route::get( '/get_dashboard_statistics', 'DashboardController@get_dashboard_statistics' );

		// Profile
		Route::get( 'get_logged_user', 'HomeController@logged_user' );
		Route::put( 'edit_user_profile/{user}', 'HomeController@edit_user_profile' );
		Route::post( 'update_profile', 'HomeController@update_profile' );
		Route::post( 'change_password', 'HomeController@change_password' );
		Route::delete( 'delete_user_profile/{user}', 'HomeController@delete_user_profile' );
		Route::get( 'image-upload', 'ImageUploadController@imageUpload' )->name( 'image.upload' );
		Route::post( 'image-upload', 'ImageUploadController@imageUploadPost' );
		Route::post( 'update_company_logo', 'ImageUploadController@update_company_logo' );

		// Route::post( 'search_to_block_user', 'HomeController@search_to_block_user' );
		// Route::post( 'user_settings', 'HomeController@block_user' );
		// User Images

		// Route::get( 'all_playlists', 'HomeController@get_playlist' );
		// Route::post( 'delete_playlist', 'HomeController@delete_playlist' );
		// Route::post( 'update_playlist', 'HomeController@update_playlist' );
		Route::get( 'videos_likes', 'HomeController@update_likes' );
		Route::get( 'videos_dislikes', 'HomeController@update_dislikes' );
		Route::post( 'post_comment', 'CommentsController@store' )->name( 'post_comment' );
		Route::post( 'delete_comment', 'CommentsController@destroy' )->name( 'delete_comment' );
		Route::get( 'get_total_comments', 'CommentsController@countTotalComments' );
		Route::post( 'createVideoAction', 'VideoController@createVideoAction' )->name( 'createVideoAction' );
		Route::get( '/categories', 'CategoryController@index' );
		Route::get('my_ratings','UserMessageController@my_ratings')->name('my_ratings');
	}
);

Route::group(
	array( 'middleware' => 'admin' ),
	function () {
		Route::prefix( 'admin' )->group(
			function () {
                Route::view('/', 'admin.home')->name('admin_panel');
                Route::resource('categories', 'Admin\\CategoriesController');
                Route::resource('pages', 'Admin\\PagesController');
                Route::resource('user-categories', 'Admin\\UserCategoriesController');
                Route::resource('videos', 'Admin\\VideosController');
                Route::resource('users', 'Admin\\UsersController');
                Route::resource('settings', 'Admin\\SettingsController');
                Route::view('profile', 'admin.users.profile')->name('admin.profile');
                Route::resource('user_message', 'UserMessageController');
                Route::get('admin_uploads', 'Admin\\VideosController@upload')->name('admin_uploads.upload');
                Route::post('admin_uploads', 'Admin\\VideosController@store')->name('admin_uploads.store');
                Route::get('/my_videos', 'Admin\\VideosController@my_videos')->name('admin.my_videos');
                Route::get('/my_video/edit/{id}', 'Admin\\VideosController@edit_my_video')->name('admin.my_video.edit');
                Route::post('/my_video/edit/{id}', 'Admin\\VideosController@update_my_video')->name('admin.update_my_video');
                Route::get('reported_query_videos', 'UserMessageController@reported_videos')->name('reported_query_videos');
            }
		);
	}
);

Route::get('watch', 'MainController@watch_from_admin')->name('admin_uploads.watch');


// Home
Route::get( '/', 'MainController@index' )->name( 'home' );
// Directory
Route::get( '/directory/{level1?}/{level2?}', 'MainController@directory' )->name( 'directory' );
// Embed Videos
Route::get( '/embed/{video_id}', 'MainController@embed' )->name( 'embed_video' );
// Play Video Analytics
Route::put( 'is_play/{video}', 'MainController@isplay' )->name( 'is_played' );

// Pages
Route::get( '/{slug}/{video_id?}', 'MainController@page_or_username' )->middleware( \App\Http\Middleware\IsUserNameMiddleware::class )->name( 'directory_by_username' );
// Route::get( '/{slug}', 'MainController@page' )->middleware(\App\Http\Middleware\IsPageMiddleware::class)->name( 'pages' );






