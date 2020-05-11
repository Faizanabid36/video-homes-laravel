<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VideoView extends Model
{
    //
    protected $table = 'video_views';

    public static function createViewLog($video)
    {
        $postsViews = new VideoView();
        $postsViews->video_id = $video->id;
        $postsViews->video_slug = $video->video_id;
        $postsViews->url = \Request::fullUrl();
        $postsViews->session_id = \Request::getSession()->getId();
        $postsViews->ip = \Request::getClientIp();
        $postsViews->agent = \Request::header('User-Agent');
        $postsViews->save();
    }

    public static function getTotalViews()
    {
        return VideoView::all()->count();
    }

    public static function getTotalVideoViews($video)
    {
        return VideoView::where('video_id', $video->id)->where('video_slug', $video->video_id)->count();
    }

    public static function getMostViewed()
    {
        return VideoView::select(array('video_views.video_id', \DB::raw('COUNT(video_id) as views')))
            ->orderBy(\DB::raw('COUNT(video_id)'), 'desc')
            ->groupBy('video_id')->get();
    }

    public static function getViewsByDays($video, $time)
    {
        return VideoView::select(array('video_views.video_id', \DB::raw('COUNT(video_id) as views')))
            ->where('video_id', $video->id)
            ->where('created_at', '>=', $time)
            ->orderBy(\DB::raw('COUNT(video_id)'), 'desc')
            ->groupBy('video_id')->first();
    }
}
