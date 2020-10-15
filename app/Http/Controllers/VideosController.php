<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Jobs\ConvertVideoForStreaming;
use App\Video;
use App\VideoAction;
use App\VideoView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$Videos = Video::where( 'user_id', auth()->id() )->where( 'processed', 1 )->latest()->with( array( 'user', 'category' ) )->get();

		$videos = $Videos->groupBy( 'is_video_approved' );

		$pendingVideos  = array();
		$approvedVideos = array();
		if ( isset( $videos[0] ) ) {
			$pendingVideos = collect( $videos[0] )->map(
				function ( $video ) {
					$v     = VideoView::getTotalVideoViews( $video );
					$views = ! is_null( $v ) ? $v : 0;
					return collect( $video )->merge(
						array(
							'views'   => $views,
							'daysAgo' => $video->created_at->diffForHumans(),
						)
					);
				}
			);
		}
		if ( isset( $videos[1] ) ) {
			$approvedVideos = collect( $videos[1] )->map(
				function ( $video ) {
					$v     = VideoView::getTotalVideoViews( $video );
					$views = ! is_null( $v ) ? $v : 0;
					return collect( $video )->merge(
						array(
							'views'   => $views,
							'daysAgo' => $video->created_at->diffForHumans(),
						)
					);
				}
			);
		}
		return compact( 'approvedVideos', 'pendingVideos' );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$file = \Str::random( 16 ) . '.' . request()->video->getClientOriginalExtension();
				request()->video->storeAs( 'public/uploads/', $file );
				$path        = 'uploads/' . $file;
				$media       = \FFMpeg::open( $path );
				$videostream = $media->getStreams()->videos()->first();
				$angle       = getVideoRotation( $videostream );
				Log::info( "Rotation: $angle" );
				$dimension     = $videostream->getDimensions();
				$newThumbnails = generateThumbnailsFromVideo( $media, $path, $angle );
				$video         = Video::create(
					array(
						'thumbnail'     => $newThumbnails[1],
						'original_name' => request()->video->getClientOriginalName(),
						'video_path'    => $path,
						'title'         => request()->video->getClientOriginalName(),
						'duration'      => $media->getDurationInSeconds(),
						'size'          => request()->video->getSize(),
						'category_id'   => 1,
						'video_type'    => 'Public',
						'width'         => $dimension->getWidth(),
						'stream_path'   => getCleanFileName( $path, '_240p_converted.mp4' ),
					)
				);

				ConvertVideoForStreaming::dispatch(
					$video,
					320,
					240,
					array(
						'converted_for_streaming_at' => Carbon::now(),
						'processed'                  => true,
					),
					$angle
				);
		if ( $video->width >= 640 ) {
			ConvertVideoForStreaming::dispatch( $video, 640, 360, array( '360p' => 1 ), $angle );
		}
		if ( $video->width >= 854 ) {
			ConvertVideoForStreaming::dispatch( $video, 854, 480, array( '480p' => 1 ), $angle, 1000 );
		}
		if ( $video->width >= 1280 ) {
			ConvertVideoForStreaming::dispatch( $video, 1280, 720, array( '720p' => 1 ), $angle, 1000 );
		}
		if ( $video->width >= 1920 ) {
			ConvertVideoForStreaming::dispatch( $video, 1920, 1080, array( '1080p' => 1 ), $angle, 2000 );
		}
		if ( $video->width >= 2560 ) {
			ConvertVideoForStreaming::dispatch( $video, 2560, 1440, array( '1440p' => 1 ), $angle, 2000 );
		}
		if ( $video->width >= 3840 ) {
			ConvertVideoForStreaming::dispatch( $video, 3840, 2160, array( '4k' => 1 ), $angle, 2000 );
		}
		if ( $video->width >= 7680 ) {
			ConvertVideoForStreaming::dispatch( $video, 7680, 4320, array( '8k' => 1 ), $angle, 2000 );
		}
				$message = 'Video is uploading... in background';

				return compact( 'message', 'video' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		$video      = Video::whereVideoId( $id )->without( array( 'user', 'comments' ) )->firstOrFail();
		$categories = Category::orderBy( 'name', 'ASC' )->get();
		$thumbnails = array();
		for ( $i = 1; $i <= 3; $i++ ) {
			$thumbnails[ $i ] = preg_replace( '/(-)\d(\.png)/', "-$i$2", $video->thumbnail, 1 );
		}
		$video->username = auth()->user()->username;

		return compact( 'video', 'thumbnails', 'categories' );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\Response
	 */
	public function update( $id ) {
		$video = Video::whereVideoId( $id )->firstOrFail();
		return array( 'status' => $video->update( request( array( 'description', 'title', 'thumbnail', 'video_type', 'tags', 'category_id' ) ) ) );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		Video::whereUserId( auth()->id() )->find( $id )->delete();
		return array( 'success' => 1 );
	}
}
