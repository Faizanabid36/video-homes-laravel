<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }
    public function videos_for_approval()
    {
        $videos = Video::where('is_video_approved', 0)->get();
        return view('admin.videos_for_approval',compact('videos'));
    }
}
