<?php

namespace App\Jobs;

use App\Video;
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
    public $video, $width, $height, $bitrate, $update;

    /**
     * Create a new job instance.
     *
     * @param Video $video
     */
    public function __construct( Video $video, $width, $height, $update = [], $bitrate = '500' ) {
        //
        $this->video   = $video;
        $this->width   = $width;
        $this->height  = $height;
        $this->bitrate = $bitrate;
        $this->update  = $update;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        // create a video format...
        $lowBitrateFormat = ( new X264( 'libmp3lame', 'libx264' ) )->setKiloBitrate( $this->bitrate );
//        $angle = RotateFilter::ROTATE_180;
//        Log::info( "ESsa: 180", [ "tes" => $angle ] );
//        $media->filters()->rotate( $angle );
        \FFMpeg::open( $this->video->video_path )
               ->addFilter( function ( $filters ) {
//                   $filters->rotate(RotateFilter::ROTATE_180);
                   $filters->resize( new Dimension( $this->width, $this->height ) );
               } )
               ->export()
               ->inFormat( $lowBitrateFormat )
               ->save( getCleanFileName($this->video->video_path, "_{$this->height}p_converted.mp4")  );

        // update the database so we know the convertion is done!
        Log::info('This is some useful information.',["file_path"=>$this->video->stream_path . "_{$this->height}p_converted.mp4","update"=>$this->update]);

        $this->video->update( $this->update );
    }


}
