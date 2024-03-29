<?php

namespace App\Jobs;

use App\Video;
use Exception;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Video\RotateFilter;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ConvertVideoForStreaming implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	public $video, $width, $height, $bitrate, $update, $angle;

	/**
	 * Create a new job instance.
	 *
	 * @param Video $video
	 */
	public function __construct( Video $video, $width, $height, $update = array(), $angle = false, $bitrate = '500' ) {
				$this->video = $video;
		$this->width         = $width;
		$this->height        = $height;
		$this->bitrate       = $bitrate;
		$this->update        = $update;
		$this->angle         = $this->getAngle( $angle );
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		// create a video format...
		$lowBitrateFormat = ( new X264( 'aac', 'libx264' ) )->setKiloBitrate( 1000 );
		$public           = 'public/';
		$video            = \FFMpeg::open( $public . $this->video->video_path );
		Log::info( 'Essa Outside Angle', array( $this->angle, $public . $this->video->video_path, $video ) );
		if ( $this->angle ) {
			Log::info( 'Essa Inside Angle', array( $this->angle ) );
			$video->filters()->rotate( $this->angle );
		}
		$video
		->filters()->pad( new Dimension( $this->width, $this->height ) );

		// update the database so we know the convertion is done!
		Log::info(
			'This is some useful information.',
			array(
				'file_path' => $public . $this->video->stream_path . "_{$this->height}p_converted.mp4",
			)
		);
		try {
			$video->export()
			->onProgress(
				function ( $percentage, $remaining, $rate ) {
					Log::alert( 'Percentage : ', array( "{$percentage}% transcoded", "{$remaining} seconds left at rate: {$rate}" ) );
				}
			)
			->inFormat( $lowBitrateFormat )
			->addFilter( array( '-movflags', '+faststart' ) )
			->save( getCleanFileName( $public . $this->video->video_path, "_{$this->height}p_converted.mp4" ) );
		} catch ( Exception $e ) {
			Log::error(
				'JOB Export Error!!!!!!!!',
				array( $e->getMessage() )
			);
		}

		Log::info(
			'CHECKING UPDATE VARIABLE ON VIDEO',
			array(
				'title'  => $this->video->title,
				'update' => $this->update,
			)
		);

		$this->video->update( $this->update );
	}

	private function getAngle( $angle ) {
		switch ( $angle ) {
			case 270:
				return RotateFilter::ROTATE_270;
			case 180:
				return RotateFilter::ROTATE_180;
			case 90:
				return RotateFilter::ROTATE_90;
		}
		return false;
	}


}
