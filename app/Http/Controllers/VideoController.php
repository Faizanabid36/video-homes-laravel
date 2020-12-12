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
use Image;

class VideoController extends Controller {



	// public function upload_video(StoreVideoRequest $request)
	public function upload_video() {
		// dd(request('video'));
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
				'video_path'    => str_replace( 'path/', '', $path ),
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

	public function getComments( $video_id ) {
		return array(
			'comments'       => Comment::whereVideoId( $video_id )->latest()->get(),
			'comments_count' => Comment::whereVideoId( $video_id )->count(),
		);
	}

	public function watch_video( $username ) {
		// if(!isset(auth()->user()->id))
		// {
		// abort(404);
		// }
		// if (isset(auth()->user()->id)) {
		// $BlockedUser = BlockedUser::where('blocked_user_id', auth()->user()->id)
		// ->where('user_id', $user->id)->first();
		// if (!is_null($BlockedUser)) {
		// return view('errors.restricted');
		// }
		// }
		$video = Video::whereHas(
			'user',
			function ( $query ) use ( $username ) {
				$query->whereUsername( $username );
			}
		)->whereVideoId( request( 'v' ) )->firstOrFail();
		if ( ! $video->processed ) {
			return view( 'errors.processing' )->with( 'video', $video );
		}

		// if (!$video->is_video_approved) {
		// return view('errors.pending_approval')->with('video', $video);
		// }
		$related_videos = Video::whereUserId( $video->user->id )
			->whereProcessed( 1 )->where( 'video_id', '!=', request( 'v' ) )
			->with( 'user' )->latest()->take( 1 )->get();
		$view_id        = VideoView::createViewLog( $video );
		$totalViews     = VideoView::getTotalVideoViews( $video );
		$comments       = $this->getComments( $video->id );
		$video_actions  = '';
		if ( isset( auth()->user()->id ) ) {
			$video_actions = VideoAction::where( 'user_id', auth()->user()->id )->where( 'video_id', $video->id )->get();
		}
		return view( 'watch_video', compact( 'video', 'related_videos', 'totalViews', 'comments', 'video_actions', 'view_id' ) );

	}

	public function watchable_video( $username ) {
		$video = Video::whereHas(
			'user',
			function ( $query ) use ( $username ) {
				$query->whereUsername( $username );
			}
		)->whereVideoId( request( 'v' ) )->firstOrFail();
		return array( 'isProcessed' => $video->processed );
	}

	public function list_of_videos() {
		$Videos         = Video::where( 'user_id', auth()->user()->id )->where( 'processed', 1 )->latest()->with( 'user' )->with( 'category' )->get();
		$videos         = $Videos->groupBy( 'is_video_approved' );
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


	public function list_of_videos_by_order( $order ) {
		$Videos = Video::where( 'user_id', auth()->user()->id )->where( 'processed', 1 )->latest()->with( 'user' )->with( 'category' )->get();
		$videos = $Videos->groupBy( 'is_video_approved' );
		// return compact('videos');
		$pendingVideos  = array();
		$approvedVideos = array();
		if ( count( $videos ) > 0 ) {
			if ( ! isset( $videos[0] ) ) {
				$videos[0] = array();
			}
			if ( ! isset( $videos[1] ) ) {
				$videos[1] = array();
			}
			switch ( $order ) {
				case 'oldest':
					$pendingVideos  = isset( $videos[0] ) ? sortVideosInOrder( 'created_at', $videos[0] ) : array();
					$approvedVideos = isset( $videos[1] ) ? sortVideosInOrder( 'created_at', $videos[1] ) : array();
					break;
				case 'popular':
					$pendingVideos  = sortVideosInOrder( 'views', $videos[0] );
					$approvedVideos = sortVideosInOrder( 'views', $videos[1] );
					break;
				case 'alphabetical':
					$pendingVideos  = sortVideosInOrder( 'title', $videos[0] );
					$approvedVideos = sortVideosInOrder( 'title', $videos[1] );
					break;
				default:
					$pendingVideos  = sortVideosInOrder( 'newest', $videos[0] );
					$approvedVideos = sortVideosInOrder( 'newest', $videos[1] );
					break;
			}
		}
		return compact( 'approvedVideos', 'pendingVideos' );
	}

	public function update_video( Video $video ) {
		return array( 'status' => $video->update( request( array( 'description', 'title', 'thumbnail', 'video_type', 'tags', 'category_id' ) ) ) );
	}

	public function edit_video( $video_id ) {
		$video      = Video::whereVideoId( $video_id )->firstOrFail();
		$categories = Category::all();
		$thumbnails = array();
		for ( $i = 1; $i <= 3; $i++ ) {
			$thumbnails[ $i ] = preg_replace( '/(-)\d(\.png)/', "-$i$2", $video->thumbnail, 1 );
		}
		$video->username = auth()->user()->username;
		$user            = auth()->user();
		return compact( 'video', 'thumbnails', 'categories', 'user' );
	}

	public function get_embedded_video( $video_id ) {
		$video   = Video::whereVideoId( $video_id )->whereProcessed( 1 )->firstOrFail();
		$view_id = VideoView::createViewLog( $video );
		VideoView::whereId( $view_id )->update( array( 'from_website' => 0 ) );
		return view( 'embed_video', compact( 'video' ) );
	}

	public function createVideoAction( Request $request ) {
		$this->validate(
			$request,
			array(
				'start_minute' => 'required|min:0',
				'start_second' => 'required|min:0|max:59',
				'end_minute'   => 'required|min:0',
				'end_second'   => 'required|min:0|max:59',
				'title'        => 'required',
				'url'          => 'required',
			)
		);
		$start_time = 0;
		$end_time   = 0;
		$s_minute   = $request->input( 'start_minute' );
		$s_second   = $request->input( 'start_second' );
		$e_minute   = $request->input( 'end_minute' );
		$e_second   = $request->input( 'end_second' );
		if ( ! is_null( $s_minute ) || $s_minute != 0 ) {
			$start_time = $s_minute * 60;
		}
		$start_time += ! is_null( $s_second ) ? $s_second : 0;

		if ( ! is_null( $e_minute ) || $e_minute != 0 ) {
			$end_time = $e_minute * 60;
		}
		$end_time += ! is_null( $e_second ) ? $e_second : 0;
		if ( $end_time <= $start_time ) {
			return back()->with( 'error', 'Start Time must be less than Ending Time' );
		}
		VideoAction::create(
			array(
				'video_id'   => $request->input( 'video_id' ),
				'user_id'    => auth()->user()->id,
				'start_time' => $start_time,
				'end_time'   => $end_time,
				'title'      => $request->input( 'title' ),
				'url'        => $request->input( 'url' ),
			)
		);
		return back()->with( 'success', 'Action Created' );
	}

	public function delete_video( Request $request ) {
		Video::whereId( $request->get( 'id' ) )->delete();
		return array( 'success' => 1 );
	}

}
