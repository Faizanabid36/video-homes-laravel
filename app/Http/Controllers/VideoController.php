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
use Illuminate\Support\Str;
use Pbmedia\LaravelFFMpeg\FFMpeg;

class VideoController extends Controller {
    //
    public function upload_video( StoreVideoRequest $request ) {
        $file = \Str::random( 16 ) . '.' . request()->video->getClientOriginalExtension();
        request()->video->storeAs( 'public/uploads/', $file );
        $path          = 'uploads/' . $file;
        $media         = \FFMpeg::open( $path );
        $newThumbnails = generateThumbnailsFromVideo( $media, 3 );
        $video         = Video::create( [
            'thumbnail'     => $newThumbnails[1],
            'original_name' => request()->video->getClientOriginalName(),
            'video_path'    => $path,
            'title'         => request()->video->getClientOriginalName(),
            'duration'      => $media->getDurationInSeconds(),
            'size'          => request()->video->getSize(),
            'video_motion'  => 'Animation',
            'video_type'    => 'Public',
            'width'         => $media->getStreams()->videos()->first()->getDimensions()->getWidth()
        ] );
        ConvertVideoForStreaming::dispatch( $video, 320, 240 );
        if ( $this->width >= 640 ) {
            ConvertVideoForStreaming::dispatch( $video, 640, 360, [ '360p' => 1 ] );
        }
        if ( $this->width >= 854 ) {
            ConvertVideoForStreaming::dispatch( $video, 854, 480, [ '480p' => 1 ] );
        }
        if ( $this->width >= 1280 ) {
            ConvertVideoForStreaming::dispatch( $video, 1280, 720, [ '720p' => 1 ] );
        }
        if ( $this->width >= 1920 ) {
            ConvertVideoForStreaming::dispatch( $video, 1920, 1080, [ '1080p' => 1 ] );
        }
        if ( $this->width >= 2560 ) {
            ConvertVideoForStreaming::dispatch( $video, 2560, 1440, [ '2048p' => 1 ] );
        }
        if ( $this->width >= 3840 ) {
            ConvertVideoForStreaming::dispatch( $video, 3840, 2160, [ '4k' => 1 ] );
        }
        if ( $this->width >= 7680 ) {
            ConvertVideoForStreaming::dispatch( $video, 7680, 4320, [ '8k' => 1 ] );
        }

        $message = "Video is uploading... in backgroud";

        return compact( 'message', 'video', 'newThumbnails' );
    }

    public function watch_video() {
        $video = Video::where( 'video_id', request( 'v' ) )->first();
        abort_if( ! $video->processed, 201, 'Video Encoding is in process, Please wait a while' );

        return view( 'watch_video', $video );
    }

    public function list_of_videos() {
        $videos = Video::whereUserId( auth()->id() )->latest()->get();

        return compact( 'videos' );
    }

    public function update_video( Video $video ) {
        //dd($video);

        return [
            'status' => $video->update( request( [ 'description', 'title', 'thumbnail' ] ) ),
            'data'   => request()->all()
        ];
    }
}
