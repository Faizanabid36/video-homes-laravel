<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForStreaming;
use Image;
use App\Video;
use Carbon\Carbon;

class VideoController extends Controller
{


    public function upload_video(StoreVideoRequest $request)
    {

        $file = \Str::random(16) . '.' . request()->video->getClientOriginalExtension();
        request()->video->storeAs('public/uploads/', $file);
        $path = 'uploads/' . $file;
        $media = \FFMpeg::open($path);
        $videostream = $media->getStreams()->videos()->first();
        $angle = getVideoRotation($videostream);

        $dimension = $videostream->getDimensions();
        $newThumbnails = generateThumbnailsFromVideo($media, $path, $angle);
        $video = Video::create([
            'thumbnail' => $newThumbnails[1],
            'original_name' => request()->video->getClientOriginalName(),
            'video_path' => $path,
            'title' => request()->video->getClientOriginalName(),
            'duration' => $media->getDurationInSeconds(),
            'size' => request()->video->getSize(),
            'video_motion' => 1,
            'video_type' => 'Public',
            'width' => $dimension->getWidth(),
            'stream_path' => getCleanFileName($path, '_240p_converted.mp4')
        ]);
        ConvertVideoForStreaming::dispatch($video, 320, 240, [
            'converted_for_streaming_at' => Carbon::now(),
            'processed' => true
        ], $angle);
        if ($video->width >= 640) {
            ConvertVideoForStreaming::dispatch($video, 640, 360, ['360p' => 1], $angle);
        }
        if ($video->width >= 854) {
            ConvertVideoForStreaming::dispatch($video, 854, 480, ['480p' => 1], $angle, 1000);
        }
        if ($video->width >= 1280) {
            ConvertVideoForStreaming::dispatch($video, 1280, 720, ['720p' => 1], $angle, 1000);
        }
        if ($video->width >= 1920) {
            ConvertVideoForStreaming::dispatch($video, 1920, 1080, ['1080p' => 1], $angle, 2000);
        }
        if ($video->width >= 2560) {
            ConvertVideoForStreaming::dispatch($video, 2560, 1440, ['1440p' => 1], $angle, 2000);
        }
        if ($video->width >= 3840) {
            ConvertVideoForStreaming::dispatch($video, 3840, 2160, ['4k' => 1], $angle, 2000);
        }
        if ($video->width >= 7680) {
            ConvertVideoForStreaming::dispatch($video, 7680, 4320, ['8k' => 1], $angle, 2000);
        }

        $message = "Video is uploading... in backgroud";

        return compact('message', 'video');
    }

    public function watch_video($username)
    {
        $video = Video::whereHas('user', function ($query) use ($username) {
            $query->whereUsername($username);
        })->whereVideoId(request('v'))->firstOrFail();
        if (!$video->processed) {
            return view('errors.processing')->with('video', $video);
        }
        $related_videos = Video::whereUserId($video->user->id)
            ->whereProcessed(1)->where('video_id', '!=', request('v'))->with('user')
            ->latest()->take(3)->get();

        return view('watch_video', compact('video', 'related_videos'));

    }

    public function watchable_video($username)
    {
        $video = Video::whereHas('user', function ($query) use ($username) {
            $query->whereUsername($username);
        })->whereVideoId(request('v'))->firstOrFail();
        return ['isProcessed'=>$video->processed];
    }

    public function list_of_videos()
    {
        $videos = Video::latest()->with('user')->get();

        return compact('videos');
    }

    public function update_video(Video $video)
    {
        return ['status' => $video->update(request(['description', 'title', 'thumbnail']))];
    }
    public function edit_video($video_id){
        $video = Video::whereVideoId($video_id)->firstOrFail();
        $thumbnails = [];
        for ($i=1;$i<=3;$i++){
            $thumbnails[$i] = str_replace('1.png',"$i.png",$video->thumbnail);
        }
        $video->username = auth()->user()->username;
        return compact('video','thumbnails');
    }

}
