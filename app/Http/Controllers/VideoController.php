<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForStreaming;
use Image;
use App\Video;
use App\User;

class VideoController extends Controller {


    public function upload_video( StoreVideoRequest $request ) {

        $file = \Str::random( 16 ) . '.' . request()->video->getClientOriginalExtension();
        request()->video->storeAs( 'public/uploads/', $file );
        $path          = 'uploads/' . $file;
        $media         = \FFMpeg::open( $path );
        $dimension     = $media->getStreams()->videos()->first()->getDimensions();
        $newThumbnails = generateThumbnailsFromVideo( $media, $path, 3 );
        dd($dimension->getWidth());
        $video         = Video::create( [
            'thumbnail'     => $newThumbnails[1],
            'original_name' => request()->video->getClientOriginalName(),
            'video_path'    => $path,
            'title'         => request()->video->getClientOriginalName(),
            'duration'      => $media->getDurationInSeconds(),
            'size'          => request()->video->getSize(),
            'video_motion'  => 'Animation',
            'video_type'    => 'Public',
            'width'         => $dimension->getWidth()
        ] );
        ConvertVideoForStreaming::dispatch( $video, 320, 240 );
        if ( $this->width >= 640 ) {
            ConvertVideoForStreaming::dispatch( $video, 640, 360, [ '360p' => 1 ] );
        }
        if ( $this->width >= 854 ) {
            ConvertVideoForStreaming::dispatch( $video, 854, 480, [ '480p' => 1 ],1000 );
        }
        if ( $this->width >= 1280 ) {
            ConvertVideoForStreaming::dispatch( $video, 1280, 720, [ '720p' => 1 ],1000 );
        }
        if ( $this->width >= 1920 ) {
            ConvertVideoForStreaming::dispatch( $video, 1920, 1080, [ '1080p' => 1 ],1000 );
        }
        if ( $this->width >= 2560 ) {
            ConvertVideoForStreaming::dispatch( $video, 2560, 1440, [ '2048p' => 1 ],1000 );
        }
        if ( $this->width >= 3840 ) {
            ConvertVideoForStreaming::dispatch( $video, 3840, 2160, [ '4k' => 1 ],1000 );
        }
        if ( $this->width >= 7680 ) {
            ConvertVideoForStreaming::dispatch( $video, 7680, 4320, [ '8k' => 1 ] );
        }

        $message = "Video is uploading... in backgroud";

        return compact( 'message', 'video', 'newThumbnails' );
    }

    public function watch_video( $username ) {
        $user  = User::whereUsername( $username )->first();
        $video = Video::where( 'video_id', request( 'v' ) )->where( 'user_id', $user->id )->with( 'user' )->first();
        abort_if( ! $video->processed, 201, 'Video Encoding is in process, Please wait a while' );
        $related_video = Video::whereUserId( $user->id )->where( 'video_id', '!=', request( 'v' ) )
                              ->with( 'user' )->latest()->first();

//        return compact('video', 'related_video');
        return view( 'watch_video', compact( 'video', 'related_video' ) );

    }

    public function list_of_videos() {
        $videos = Video::latest()->with( 'user' )->get();

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
