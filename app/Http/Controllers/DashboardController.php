<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Video;
use App\VideoView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function dashboard_type(Request $request)
    {
        $endDate = \request('endDate');
        $startDate = \request('startDate');
        $time = [$startDate, $endDate];
        $videos = Video::whereUserId(auth()->user()->id)->get();
        $videosWithViews = collect($videos)->map(function ($video) use ($time) {
            $comments = Comment::where('video_id', $video->id)->where('created_at', '>=', \Carbon\Carbon::parse($time[0]))
                ->where('created_at', '<=', \Carbon\Carbon::parse($time[1]))->get()->count();
            $v = VideoView::getViewsByDays($video, $time);
            $views = !is_null($v) ? $v->views : 0;
            return collect($video)->merge(['views' => $views, 'comments' => $comments, 'commentsCount' => count($video->comments)]);
        });
        return compact('videosWithViews');
    }

    public function get_dashboard_statistics()
    {
        $videoswithDate = VideoView::getLineChartData();
        $lineChart = [];
        foreach ($videoswithDate as $key => $value)
            $lineChart[] = (object)['date' => $key, 'views' => count($value)];

        $barData = collect(Video::mostWatchedVideos()->take(5)->get())->map(function ($v) {
            return collect($v)->only('original_name', 'views_count');
        });
        $loadedOrViewed = collect(VideoView::loadedOrViewed()->get())->map(function ($data) {
            return ['type' => $data->is_played == 0 ? 'loaded' : 'played', 'count' => $data->views];
        });
        $viewsSource = collect(VideoView::viewsSource()->get())->map(function ($d) {
            return ['source' => $d->from_website == 0 ? 'From Videohomes Video Pages' : 'From Videohomes.com', 'views' => $d->views];
        });

        return compact('lineChart', 'barData', 'loadedOrViewed', 'viewsSource');
    }

    public function single_video_statistics(Request $request)
    {
        $endDate = \request('endDate');
        $startDate = \request('startDate');
        $video_id = \request('video_id');
        $videoswithDate = VideoView::getLineChartDataWitinRange($startDate, $endDate, $video_id);
        foreach ($videoswithDate as $key => $value)
            $lineChart[] = (object)['date' => $key, 'views' => count($value)];
        $barData = collect(Video::mostWatchedVideos($video_id)->take(5)->get())->map(function ($v) {
            return collect($v)->only('original_name', 'views_count');
        });
        $loadedOrViewed = collect(VideoView::loadedOrViewed($video_id)->get())->map(function ($data) {
            return ['type' => $data->is_played == 0 ? 'loaded' : 'played', 'count' => $data->views];
        });
        $viewsSource = collect(VideoView::viewsSource($video_id)->get())->map(function ($d) {
            return ['source' => $d->from_website == 0 ? 'From Videohomes Video Pages' : 'From Videohomes.com', 'views' => $d->views];
        });
        return ['lineChart' => $lineChart, 'loadedOrViewed' => $loadedOrViewed, 'viewsSource' => $viewsSource];
    }

}
