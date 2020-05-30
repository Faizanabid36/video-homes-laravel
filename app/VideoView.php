<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VideoView extends Model
{
    //
    protected $table = 'video_views';

    protected $guarded = [];

    public static function createViewLog($video)
    {
        $postsViews = [
            'video_id' => $video->id,
            'video_slug' => $video->video_id,
            'url' => \Request::fullUrl(),
            'session_id' => \Request::getSession()->getId(),
            'ip' => \Request::getClientIp(),
            'agent' => \Request::header('User-Agent'),
            'video_user'=>$video->user_id,
        ];
        $view = VideoView::updateOrCreate([
            'video_id' => $video->id,
            'ip' => \Request::getClientIp()
        ], $postsViews);
        return $view->id;
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
            ->where('created_at', '>=', \Carbon\Carbon::parse($time[0]))
            ->where('created_at', '<=', \Carbon\Carbon::parse($time[1]))
            ->orderBy(\DB::raw('COUNT(video_id)'), 'desc')
            ->groupBy('video_id')->first();
    }
}
