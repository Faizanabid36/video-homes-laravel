<?php

namespace App\Jobs;

use App\Video;
use App\VideoView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DeleteVideos implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	protected $video;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct( $video ) {
				$this->video = $video;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
				$video = $this->video;
		Storage::delete( $video->video_path );
		Storage::delete( $video->stream_path );
		for ( $i = 1; $i < 3; $i ++ ) {
			Storage::delete( str_replace( '-1.png', "-$i.png", $video->thumbnail ) );
		}
		if ( $video->{'360p'} ) {
			Storage::delete( str_replace( '240p', '360p', $video->stream_path ) );
		}
		if ( $video->{'480p'} ) {
			Storage::delete( str_replace( '240p', '480p', $video->stream_path ) );
		}
		if ( $video->{'720p'} ) {
			Storage::delete( str_replace( '240p', '720p', $video->stream_path ) );
		}
		if ( $video->{'1080p'} ) {
			Storage::delete( str_replace( '240p', '1080p', $video->stream_path ) );
		}
		if ( $video->{'1440p'} ) {
			Storage::delete( str_replace( '240p', '1440p', $video->stream_path ) );
		}
		if ( $video->{'4K'} ) {
			Storage::delete( str_replace( '240p', '4K', $video->stream_path ) );
		}
		if ( $video->{'8k'} ) {
			Storage::delete( str_replace( '240p', '8k', $video->stream_path ) );
		}

		$video->delete();
	}
}
