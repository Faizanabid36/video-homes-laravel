<?php

namespace App\Jobs;

use App\Video;
use Carbon\Carbon;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConvertVideoForStreaming implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $video;
    /**
     * Create a new job instance.
     *
     * @param Video $video
     */
    public function __construct( Video $video){
        //
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        // create a video format...

        $converted_name = $this->getCleanFileName( $this->video->video_path );
//die($converted_name);
        $lowBitrateFormat = ( new X264( 'libmp3lame', 'libx264' ) )->setKiloBitrate( 500 );

        \FFMpeg::open( $this->video->video_path )
               ->addFilter( function ( $filters ) {
                $filters->resize( new Dimension( 960, 540 ) );
            } )
               ->export()->inFormat( $lowBitrateFormat )
               ->save( $converted_name );

        // update the database so we know the convertion is done!
        $this->video->update( [
            'converted_for_streaming_at' => Carbon::now(),
            'processed'                  => true,
            'stream_path'                => $converted_name
        ] );

    }

    private function getCleanFileName( $filename ): string {
        return preg_replace( '/\\.[^.\\s]{3,4}$/', '', $filename ) . '-compressed.mp4';
    }
}
