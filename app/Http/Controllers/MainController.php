<?php

namespace App\Http\Controllers;

use App\Category;
use App\Settings;
use App\UserCategory;
use App\UserMessage;
use App\Video;
use App\VideoView;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $setting = Settings::first();

        return view('home', compact('setting'));
    }


    public function directory($level1 = null, $level2 = null)
    {
        $industries = UserCategory::getCategories();
        $categories = UserCategory::getCategories($level1, $level2);
        $video_categories = Category::all();
        $users = collect(grabUsers($categories));
        if (\request('sort') && 'oldest_to_newest' == \request('sort')) {
            $users = $users->sortBy(function ($user) {
                return $user['created_at'];
            })->values();
        } elseif (\request('sort') && 'alphabetically' == \request('sort')) {
            $users = $users->sortBy(function ($user) {
                return $user['name'];
            })->values();
        } else {
            $users = $users->sortByDesc(function ($user) {
                return $user['name'];
            })->values();
        }
        $videos = [];
        if (request('category_id')) {
            $videos = Category::approvedVideos()->find(request('category_id'));
        }
        return view('directory.index', compact('users', 'categories', 'industries', 'level1', 'video_categories', 'videos'));
    }

    public function page_or_username($username, $video_id = null)
    {
        if (request()->ajax()) {
            return ["isProcessed" => Video::userVideos($username, $video_id)->first()->processed];
        }
        if (request('page')) {
            return view('page', request()->only(['page']));
        }
        $video = Video::userVideos($username, $video_id)->where('video_type', 'Public')->with('playlist')->first();
        $views = $video ? VideoView::videoViews($video) : 0;
        $user = request('username');
        if ($user->user_extra->display_suggested_videos == 'enabled')
            $related_videos = $views ? Video::userVideos($username, $video->id, true)->where('video_type', 'Public')->get() : [];
        else
            $related_videos = [];
        $ratingsUser = UserMessage::userRating($user->id)->get();
        $total_ratings = $ratings[1] = $ratings[2] = $ratings[3] = $ratings[4] = $ratings[5] = 0;
        if (!is_null($ratingsUser)) {
            $total_ratings = $ratingsUser->count();
            $ratings = $ratingsUser->groupBy('rating');
            for ($x = 1; $x <= 5; $x++) {
                $ratings[$x] = isset($ratings[$x]) ? $ratings[$x]->count() : 0;
                $total_ratings = $total_ratings == 0 ? 1 : $total_ratings;
                $rating[$x] = ($ratings[$x] / $total_ratings) * 100;
            }
        }

        $ratings = [];
        $all_ratings = UserMessage::userRating($user->id)->get();
        if (!is_null($all_ratings))
            $ratings = collect($all_ratings)->map(function ($rate) {
                return [
                    'name' => collect($rate->user)->get('name'),
                    'video_title' => collect($rate->video)->get('title'),
                    'review' => $rate->message,
                    'rating' => $rate->rating,
                    'time' => $rate->created_at->diffForHumans(),
                    'avatar' => is_null($rate->user->user_extra->profile_picture) ? 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTMgrxYAqZF6-kdFuLQesPwdAyonhn93LsxvKXax0vzbCCGd_wQ&usqp=CAU' : $rate->user->user_extra->profile_picture,
                ];
            });
        return view($video && !$video->processed ? 'directory.processing' : 'directory.single', compact('ratings', 'user', 'rating', 'video', 'related_videos', 'views'));
    }

    public function playlist_videos(Request $request)
    {

        $video = Video::whereVideoId($request->get('v'))->firstOrFail();
//        $video = Video::userVideos($username, $video_id)->where('video_type', 'Public')->with('playlist')->first();
        $views = $video ? VideoView::videoViews($video) : 0;
        $related_videos =[];
        $related_videos = Video::wherePlaylistId($video->playlist_id)->whereUserId($video->user_id)->where('id', '!=', $video->id)->get();
        $user = $video->user;
        $username = $user->username;
        $ratingsUser = UserMessage::userRating($user->id)->get();
        $total_ratings = $ratings[1] = $ratings[2] = $ratings[3] = $ratings[4] = $ratings[5] = 0;
        if (!is_null($ratingsUser)) {
            $total_ratings = $ratingsUser->count();
            $ratings = $ratingsUser->groupBy('rating');
            for ($x = 1; $x <= 5; $x++) {
                $ratings[$x] = isset($ratings[$x]) ? $ratings[$x]->count() : 0;
                $total_ratings = $total_ratings == 0 ? 1 : $total_ratings;
                $rating[$x] = ($ratings[$x] / $total_ratings) * 100;
            }
        }

        $ratings = [];
        $all_ratings = UserMessage::userRating($user->id)->get();
        if (!is_null($all_ratings))
            $ratings = collect($all_ratings)->map(function ($rate) {
                return [
                    'name' => collect($rate->user)->get('name'),
                    'video_title' => collect($rate->video)->get('title'),
                    'review' => $rate->message,
                    'rating' => $rate->rating,
                    'time' => $rate->created_at->diffForHumans(),
                    'avatar' => is_null($rate->user->user_extra->profile_picture) ? 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTMgrxYAqZF6-kdFuLQesPwdAyonhn93LsxvKXax0vzbCCGd_wQ&usqp=CAU' : $rate->user->user_extra->profile_picture,
                ];
            });
        return view($video && !$video->processed ? 'directory.processing' : 'playlist.single', compact('ratings', 'user', 'rating', 'video', 'related_videos', 'views'));
    }

    public function embed($video_id)
    {
        $video = Video::singleVideo($video_id)->firstOrFail();
        VideoView::videoViews($video, ["from_website" => 0]);

        return view('embed_video', compact('video'));
    }

    public function watch_from_admin(Request $request)
    {
        $video = Video::whereProcessed(1)->whereVideoId($request->get('v'))->firstOrFail();
        return view('embed_video', compact('video'));
    }

    public function page($slug)
    {
        return view('page', request()->only(['page']));
    }

    public function isplay(Video $video)
    {
        return ["success" => VideoView::videoViews($video, ["is_played" => 1])];
    }

}
