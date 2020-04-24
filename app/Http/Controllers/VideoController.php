<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\ConvertVideoForDownloading;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Video;
use App\User;
use Illuminate\Support\Str;
use Pbmedia\LaravelFFMpeg\FFMpeg;

class VideoController extends Controller
{
    //
<<<<<<< HEAD
    public function upload_video(StoreVideoRequest $request)
    {
        $path = \Str::random(16) . '.' . request()->video->getClientOriginalExtension();
        request()->video->storeAs('public/uploads/', $path);
        $path = 'uploads/' . $path;
        $thumbnail = str_replace("." . request()->video->getClientOriginalExtension(), ".png", $path);
        $media = \FFMpeg::open($path);
//        dd($media);
=======
    public function upload_video( StoreVideoRequest $request ) {
        $path = \Str::random( 16 ) . '.' . request()->video->getClientOriginalExtension();
        request()->video->storeAs( 'public/uploads/', $path );
        $path      = 'uploads/' . $path;
        $thumbnail = str_replace( "." . request()->video->getClientOriginalExtension(), ".png", $path );
        $media     = \FFMpeg::open( $path );
        $dimension = $media->getStreams()
            ->videos()
            ->first()
            ->getDimensions();
        return $dimension;
>>>>>>> 466d8467a858f7ead72058e9accaa95120b82a34
        $thumbnail_shots = 5;
        $divide_result = $media->getDurationInSeconds() >= $thumbnail_shots ? floor($media->getDurationInSeconds() / $thumbnail_shots) : floor($media->getDurationInSeconds() / 1);
        $thumbnail_shots = $media->getDurationInSeconds() >= $thumbnail_shots ? $thumbnail_shots : 1;
        $newThumbnail = [];
        for ($i = 1; $i <= $thumbnail_shots; $i++) {
            $newThumbnail[$i] = str_replace("." . request()->video->getClientOriginalExtension(), "-$i.png", $path);
            $media->getFrameFromSeconds($divide_result)->export()->save($newThumbnail[$i]);
            $divide_result += $divide_result;
        }

        $video = Video::create([
            'disk' => 'public',
            'thumbnail' => $newThumbnail[1],
            'original_name' => request()->video->getClientOriginalName(),
            'video_path' => $path,
            'title' => request()->video->getClientOriginalName(),
            'user_id' => auth()->id(),
            'video_id' => \Str::random(16),
            'duration' => $media->getDurationInSeconds(),
            'size' => request()->video->getSize(),
            'video_motion' => 'Animation',
            'video_type' => 'Public',
        ]);
        ConvertVideoForStreaming::dispatch($video);
        $message = "Video is uploading... in backgroud";

        return compact('message', 'video', 'newThumbnail');
    }

    public function watch_video($username)
    {
        $user = User::whereUsername($username)->first();
        $video = Video::where('video_id', request('v'))->where('user_id', $user->id)->with('user')->first();
        abort_if(!$video->processed, 201, 'Video Encoding is in process, Please wait a while');
        $related_video = Video::whereUserId($user->id)->where('video_id', '!=', request('v'))
            ->with('user')->latest()->first();
//        return compact('video', 'related_video');
        return view('watch_video', compact('video', 'related_video'));
    }

    public function list_of_videos()
    {
        $videos = Video::latest()->with('user')->get();
        return compact('videos');
    }

    public function update_video(Video $video)
    {
        //dd($video);

        return [
            'status' => $video->update(request(['description', 'title', 'thumbnail'])),
            'data' => request()->all()
        ];
    }
}
