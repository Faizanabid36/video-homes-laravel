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

    public function statistics()
    {
        $endDate = \request('endDate');
        $startDate = \request('startDate');
        $videoswithDate = VideoView::select('video_user', 'video_id', 'created_at')
            ->where('video_user', auth()->user()->id)
            ->where('created_at', '>=', \Carbon\Carbon::parse($startDate))
            ->where('created_at', '<=', \Carbon\Carbon::parse($endDate))
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            })->toArray();
        $views = [];
        $labels = [];
        ksort($videoswithDate);
        foreach ($videoswithDate as $key => $values) {
            $labels[] = $key;
            $views[] = count($values);
        }
        $chartData = dashboardChart($labels, 'number of views', $views, false);
        $loadData = VideoView::select('is_played', \DB::raw('count(*) as views'))
            ->where('video_user', auth()->user()->id)
            ->groupBy('is_played')
            ->get();
        $totalLoads = 0;
        $totalViews = 0;
        foreach ($loadData as $key) {
            if ($key->is_played == 0)
                $totalLoads += $key->views;
            else
                $totalViews += $key->views;
        }
        $pageData = VideoView::select('from_website', \DB::raw('count(*) as views'))
            ->where('video_user', auth()->user()->id)
            ->groupBy('from_website')
            ->get();
        $fromWebsite = 0;
        $outsideWebsite = 0;
        foreach ($pageData as $key) {
            if ($key->from_website == 0)
                $outsideWebsite += $key->views;
            else
                $fromWebsite += $key->views;
        }
        $doughnutData = dashboardChart(['loads', 'views'], 'Player Impressions', [$totalLoads, $totalViews], true);
        $fromPage = dashboardChart(['From Videohomes.com', 'From Videohomes Video Pages'], 'Traffic Source', [$fromWebsite, $outsideWebsite], true);
        return compact('chartData', 'doughnutData', 'fromPage');
    }

    public function get_all_statistics()
    {
        $endDate = \request('endDate');
        $startDate = \request('startDate');
        $videoId = \request('id');
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

}
