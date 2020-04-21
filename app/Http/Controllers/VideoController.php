<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Video;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    //
    public function upload_video(Request $request)
    {
        $image = file_get_contents(\request('videos'));
        $fileName = \request('fileName');
        $message = 'Could not Upload';
        $uploaded = file_put_contents(public_path('/videos/' . $fileName), $image);
        if ($uploaded) {
            $message = 'Uploaded';
            $data['title'] = $fileName;
            $data['video_motion'] = 'Animation';
            $data['video_type'] = 'Private';
            $data['user_id'] = auth()->user()->id;
            $data['video_path'] = asset('/videos/' . $fileName);
            $data['video_id'] = Str::random(16);
            $data['duration'] = \request('duration');
            $data['size'] = \request('size');
            Video::create($data);
        }
        return compact('message');
    }

    public function watch_video()
    {
        $video_id = \request('video_id');
        $video = Video::where('video_id', $video_id)->first();
        $videoUrl = $video->video_path;
        $title = $video->title;
        return compact('videoUrl', 'title');
    }

    public function list_of_videos()
    {
        $videos = Video::all();
        return compact('videos');
    }
}
