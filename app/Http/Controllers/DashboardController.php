<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Video;
use App\VideoView;
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

        foreach ($videoswithDate as $key => $value)
            $lineChartCount[] = count($value);
        $lineChart = dashboardChart(array_keys($videoswithDate), 'Views in 7 Days', $lineChartCount ? $lineChartCount : 0);
        $BAR = Video::mostWatchedVideos()->take(5)->get();

        $barchartLabels = [];
        $barchartCount = [];
        foreach ($BAR as $data) {
            $barchartLabels[] = $data->title;
            $barchartCount[] = $data->views_count;
        }
        $barData = dashboardChart($barchartLabels, 'Top 5 Most Watched Videos', $barchartCount);
        $isplayed = [];
        $isplayed = VideoView::loadedOrViewed()->get();
        $timesPlayed = 0;
        $timesLoaded = 0;
        foreach ($isplayed as $data) {
            $data->is_played != 1 ? $timesLoaded = $data->views > 0 ? $data->views : 0 : $timesPlayed = $data->views > 0 ? $data->views : 0;
        }
        $loadedOrViewed = dashboardChart(['played', 'loaded'], 'Played or Loaded', [$timesPlayed, $timesLoaded], true);

        $views_source = VideoView::viewsSource()->get();
        foreach ($views_source as $data) {
            $data->is_played != 1 ? $timesLoaded = $data->views > 0 ? $data->views : 0 : $timesPlayed = $data->views > 0 ? $data->views : 0;
        }
        $videoPages = 0;
        $videoHomes = 0;
        foreach ($views_source as $data) {
            $data->from_website == 0 ? $videoPages = $data->views > 0 ? $data->views : 0 : $videoHomes = $data->views > 0 ? $data->views : 0;
        }
        $viewsSource = dashboardChart(['videohomes.com', 'videohomes pages'], 'Views Source', [$videoHomes, $videoPages], true);

        return compact('lineChart', 'barData', 'loadedOrViewed', 'viewsSource');
    }

    public function single_video_statistics(Request $request)
    {
        $endDate = \request('endDate');
        $startDate = \request('startDate');
        $video_id = \request('video_id');
        $videoswithDate = VideoView::getLineChartDataWitinRange($startDate, $endDate, $video_id);
        $lineChart=[];
        foreach ($videoswithDate as $key => $value)
            $lineChart[] = (object)['date' => $key, 'views' => count($value)];
        $barData = collect(Video::mostWatchedVideos($video_id)->take(5)->get())->map(function ($v) {
            return collect($v)->only('original_name', 'views_count');
        });
        $loadedOrViewed = collect(VideoView::loadedOrViewed($video_id)->get())->map(function ($data) {
            return ['type' => $data->is_played == 0 ? 'loaded' : 'played', 'count' => $data->views];
        });
        $viewsSource = collect(VideoView::viewsSource($video_id)->get())->map(function ($d) {
            return ['source' => $d->from_website == 0 ? 'From Video Pages' : 'From Videohomes.com', 'views' => $d->views];
        });
        return ['lineChart' => $lineChart, 'loadedOrViewed' => $loadedOrViewed, 'viewsSource' => $viewsSource];
    }

}
