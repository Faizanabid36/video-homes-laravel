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
        $lowBitrateFormat = ( new X264( 'copy', 'libx264' ) )
            ->setKiloBitrate( $this->bitrate )
            ->setAudioChannels( 2 )
            ->setAudioKiloBitrate( 126 )
            ->setLevel( 3.1 );
        $lowBitrateFormat->setAdditionalParameters(array('-preset','medium', '-crf','23','-x264-params','ref=4','-level', 3.0,'-profile:v','main','-movflags','+faststart'));


        $video = \FFMpeg::open( $this->video->video_path );

        if ( $this->angle ) {
            Log::info( "Essa Inside Angle", [ $this->angle ] );
            $video->filters()->rotate( $this->angle );
        }
        $video->filters()->pad( new Dimension( $this->width, $this->height ) );

        $video->export()->inFormat( $lowBitrateFormat )->save( getCleanFileName( $this->video->video_path, "_{$this->height}p_converted.mp4" ) );

        // update the database so we know the convertion is done!
        Log::info( 'This is some useful information.', [
            "file_path" => $this->video->stream_path . "_{$this->height}p_converted.mp4",
            "update"    => $this->update
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
