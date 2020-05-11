<?php

namespace App\Http\Controllers;

use App\Video;
use Carbon\Carbon;
use App\VideoView;
use Illuminate\Http\Request;
use function foo\func;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {

        return view('container');
    }

    public function dashboard_type($type)
    {
        $videos = Video::whereUserId(auth()->user()->id)->get();
        $videosWithViews = [];
        if (isset($type)) {
            $dt = Carbon::now();
            if ($type == 'today')
                $time = $dt->subDay();
            if ($type == 'this_week')
                $time = $dt->subWeek();
            if ($type == 'this_month')
                $time = $dt->subMonth();
            if ($type == 'this_year')
                $time = $dt->subYear();
            $videosWithViews = collect($videos)->map(function ($video) use ($time) {
                $v = VideoView::getViewsByDays($video, $time);
                $views = !is_null($v) ? $v->toArray() : 0;
                return collect($video)->merge(['views' => $views['views']]);
            });
        }
        return compact('videosWithViews');
    }
}
