<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForStreaming;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Video;
use Illuminate\Support\Str;
use Pbmedia\LaravelFFMpeg\FFMpeg;

class VideoController extends Controller {
    //
    public function upload_video( StoreVideoRequest $request ) {
        $path = \Str::random( 16 ) . '.' . request()->video->getClientOriginalExtension();
        request()->video->storeAs( 'public/uploads/', $path );
        $path      = 'uploads/' . $path;
        $thumbnail = str_replace( "." . request()->video->getClientOriginalExtension(), ".png", $path );
        $media     = \FFMpeg::open( $path );
//        dd($media);
        $media->getFrameFromSeconds( 10 )->export()->save( $thumbnail );

        $video = Video::create( [
            'disk'          => 'public',
            'thumbnail'     => $thumbnail,
            'original_name' => request()->video->getClientOriginalName(),
            'video_path'    => $path,
            'title'         => request()->video->getClientOriginalName(),
            'user_id'       => auth()->id(),
            'video_id'      => \Str::random( 16 ),
            'duration'      => $media->getDurationInSeconds(),
            'size'          => request()->video->getSize(),
            'video_motion'  => 'Animation',
            'video_type'    => 'Public',
        ] );
        ConvertVideoForStreaming::dispatch( $video );
        $message = "Video is uploading... in backgroud";

        return compact( 'message', 'video' );
    }

    public function watch_video() {
        $video_id = \request( 'video_id' );
        $video    = Video::where( 'video_id', $video_id )->first();
        $videoUrl = $video->video_path;
        $title    = $video->title;

        return compact( 'videoUrl', 'title' );
    }

    public function list_of_videos() {
        $videos = Video::all();

        return compact( 'videos' );
    }

    public function update_video( Video $video ) {
        return $video->update( request()->all() );
    }
}
