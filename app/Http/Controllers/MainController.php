<?php

namespace App\Http\Controllers;

use App\User;
use App\UserTags;
use App\Video;

class MainController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
// return 'sss' ;
    }

    public function directory()
    {
        $tags = UserTags::withCount('account_types')->get();
        $account_types = [];
//        foreach ($tags as $tag) {
//            $account_types[] = AccountType::where('account_type', $tag->id)->with('user')->get();
//        }
        $account_types = \App\User::with('account_types')->get();
//        return $account_types;
        return view('directory', compact('account_types', 'tags'));
    }

    public function directory_by_category($id)
    {
        $tags = [];
        $account_types = \App\User::whereHas('account_types', function ($query) use ($id) {
            return $query->where('account_type', $id);
        })->with('account_types')->get();
//        $tag=UserTags::whereId($id)->with('account_types')->first();
//        return $tag;
//        $account_types = \App\User::with('account_types')->get();
//        return $account_types;
        return view('directory', compact('account_types', 'tags'));
    }

    public function directory_by_username($username)
    {
        $video = Video::whereHas('user', function ($query) use ($username) {
            $query->whereUsername($username);
        })->latest()->first();
        $related_videos = Video::whereHas('user', function ($query) use ($username) {
            $query->whereUsername($username);
        })->where('id', '!=', $video->id)->latest()->get();
        $user = User::whereUsername($username)->with('account_types')->first();
        return view('directory_videos', compact('user', 'video', 'related_videos'));
    }

    public function joe()
    {
        return view('JoeFrenchRealtor');
    }

    public function directory_by_user_video($username, $video_id)
    {
        $user = User::whereUsername($username)->with('account_types')->first();
        $video = Video::whereHas('user', function ($query) use ($username) {
            $query->whereUsername($username);
        })->where('video_id', $video_id)->first();
        $related_videos = Video::whereHas('user', function ($query) use ($username) {
            $query->whereUsername($username);
        })->where('id', '!=', $video->id)->latest()->get();
        return view('directory_videos', compact('user', 'video', 'related_videos'));
    }
}
