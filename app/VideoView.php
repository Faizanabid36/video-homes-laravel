<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoView extends Model
{
    protected $table = 'video_views';

    protected $guarded = [];

    public static function videoViews($video, $update = [])
    {
        $postsViews = array_merge([
            'video_id' => $video->id,
            'video_slug' => $video->video_id,
            'url' => url()->full(),
            'session_id' => request()->session()->getId(),
            'ip' => request()->ip(),
            'agent' => request()->header('User-Agent'),
            'video_user'=>$video->user_id,
        ],$update);


        self::updateOrCreate([ 'video_id' => $video->id, 'ip' => request()->ip() ], $postsViews);
        return self::whereVideoId($video->id)->count();
    }

    public static function getTotalViews()
    {
        return self::all()->count();
    }

    public static function getTotalVideoViews($video)
    {
        return self::where('video_id', $video->id)->where('video_slug', $video->video_id)->count();
    }

    public static function getMostViewed()
    {
        return self::select(array('video_views.video_id', \DB::raw('COUNT(video_id) as views')))
            ->orderBy(\DB::raw('COUNT(video_id)'), 'desc')
            ->groupBy('video_id')->get();
    }

    public static function getViewsByDays($video, $time)
    {
        return self::select(array('video_views.video_id', \DB::raw('COUNT(video_id) as views')))
            ->where('video_id', $video->id)
            ->where('created_at', '<=', \Carbon\Carbon::parse($time[1]))
            ->where('created_at', '>=', \Carbon\Carbon::parse($time[0]))
            ->orderBy(\DB::raw('COUNT(video_id)'), 'desc')
            ->groupBy('video_id')->first();
    }
}
