<?php

namespace App;

use Carbon\Carbon;
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


        self::updateOrCreate(['video_id' => $video->id, 'ip' => request()->ip()], $postsViews);
        return self::whereVideoId($video->id)->count();
    }

    public static function getTotalViews()
    {
        return self::all()->count();
    }

    public static function getLineChartDataWitinRange($startDate, $endDate, $video_id)
    {
        return self::select('video_user', 'video_id', 'created_at')
            ->where('video_user', auth()->user()->id)
            ->where('created_at', '>=', \Carbon\Carbon::parse($startDate))
            ->where('created_at', '<=', \Carbon\Carbon::parse($endDate))
            ->when($video_id, function ($q) use ($video_id) {
                return $q->where('video_id', $video_id);
            })
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            })->toArray();
    }

    public static function getTotalVideoViews($video)
    {
        return self::where('video_id', $video->id)->where('video_slug', $video->video_id)->count();
    }

    public static function getMostViewed($videoName = null)
    {
        return self::selectRaw('video_views.video_id,COUNT(video_id) as views')
            ->orderBy(\DB::raw('COUNT(video_id)'), 'desc')
            ->groupBy('video_id');

    }

    public function scopeLoadedOrViewed($q, $video_id = null)
    {
        return $q->select('is_played', \DB::raw('count(*) as views'))
            ->where('video_user', auth()->user()->id)
            ->when($video_id, function ($q) use ($video_id) {
                return $q->where('video_id', $video_id);
            })
            ->groupBy('is_played');
    }

    public function scopeViewsSource($q, $video_id = null)
    {
        return $q->select('from_website', \DB::raw('count(*) as views'))
            ->where('video_user', auth()->user()->id)
            ->when($video_id, function ($q) use ($video_id) {
                return $q->where('video_id', $video_id);
            })
            ->groupBy('from_website');
    }

    public static function getLineChartData($video_id = null)
    {
        return self::select('video_user', 'video_id', 'created_at')
            ->where('video_user', auth()->user()->id)
            ->where('created_at', '>=', now()->subDay(7))
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            })->toArray();
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

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
