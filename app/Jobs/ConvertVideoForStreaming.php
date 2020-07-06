<?php

namespace App\Jobs;

use App\Video;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Video\ExtractMultipleFramesFilter;
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
    public function __construct( Video $video, $width, $height, $update = [], $angle = false, $bitrate = '500' ) {
        //
        $this->video   = $video;
        $this->width   = $width;
        $this->height  = $height;
        $this->bitrate = $bitrate;
        $this->update  = $update;
        $this->angle   = $this->getAngle( $angle );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        // create a video format...
        $lowBitrateFormat = ( new X264( 'aac', 'libx264' ) )->setKiloBitrate( 1000 );
//        $lowBitrateFormat->setInitialParameters(array('-acodec', 'copy'));

        $video = \FFMpeg::open( $this->video->video_path );
        Log::info(  "Essa Outside Angle",[$this->angle]);
        if ( $this->angle ) {
            Log::info("Essa Inside Angle",[$this->angle]);
            $video->filters()->rotate( $this->getAngle($this->angle) );
        }
        $video->filters()->pad( new Dimension( $this->width, $this->height ) );

        $video->export()->inFormat( $lowBitrateFormat )->save( getCleanFileName( $this->video->video_path, "_{$this->height}p_converted.mp4" ) );

        // update the database so we know the convertion is done!
        Log::info( 'This is some useful information.', [
            'file_path' => $this->video->stream_path . "_{$this->height}p_converted.mp4",
            'update'    => $this->update
        ] );

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
