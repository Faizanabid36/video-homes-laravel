<?php


use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;

if ( ! function_exists( 'dashboardChart' ) ) {
    function dashboardChart( $labels, $label, $data ) {
        $Data              = [];
        $Data['labels']    = $labels;
        $datasets['data']  = $data;
        $datasets['label'] = $label;
        $Data['datasets']  = [ $datasets ];

        return $Data;
    }
}

if ( ! function_exists( 'saveVideoByResolution' ) ) {
    function saveVideoByResolution( $path, $width, $height, $bitrate = '500' ) {
        // set the quality
        $savePath         = getCleanFileName( $path, "_${height}p_converted.mp4" );
        $video            = \FFMpeg::open( $path );
        $lowBitrateFormat = ( new X264( 'libmp3lame', 'libx264' ) )->setKiloBitrate( $bitrate );
        $video
            ->addFilter( function ( $filters ) use ( $width, $height ) {
                $filters->resize( new Dimension( $width, $height ) );
            } )
            ->export()
            ->inFormat( $lowBitrateFormat );
        $video->save( $savePath );

        return $savePath;
    }
}

if ( ! function_exists( 'saveVideoStream' ) ) {
    function saveVideoStream( $path, $width, $height, $bitrate = '500' ) {
        // set the quality
        $savePath         = getCleanFileName( $path, "_${height}p_converted.mp4" );
        $video            = \FFMpeg::open( $path );
        $lowBitrateFormat = ( new X264( 'libmp3lame', 'libx264' ) )->setKiloBitrate( $bitrate );
        $video
            ->addFilter( function ( $filters ) use ( $width, $height ) {
                $filters->resize( new Dimension( $width, $height ) );
            } )
            ->export()
            ->inFormat( $lowBitrateFormat );
        $video->save( $savePath );

        return $savePath;
    }
}

if ( ! function_exists( 'getCleanFileName' ) ) {
    function getCleanFileName( $filename, $suffix = '.mp4' ): string {
        return preg_replace( '/\.[^.\s]{3,4}$/', $suffix, $filename );
    }
}
if ( ! function_exists( 'generateThumbnailsFromVideo' ) ) {
    function generateThumbnailsFromVideo( $media, $path, $thumbnail_shots = 3, $angle ) {
        $thumbnail_shots = $media->getDurationInSeconds() >= $thumbnail_shots ? $thumbnail_shots : 1;
        $divide_result   = (int) floor( $media->getDurationInSeconds() / $thumbnail_shots );
        $seconds         = $divide_result;
        $newThumbnail    = [];
        for ( $i = 1; $i <= $thumbnail_shots; $i ++ ) {
            $newThumbnail[ $i ] = str_replace( "." . request()->video->getClientOriginalExtension(), "-$i.png", $path );
            if ( $angle ) {
                $media->filters()->rotate( $angle );
                $media->getFrameFromSeconds( $seconds )->export()->save( $newThumbnail[ $i ] );
            } else {
                $media->getFrameFromSeconds( $seconds )->export()->save( $newThumbnail[ $i ] );
            }

            $seconds += $divide_result;
        }

        return $newThumbnail;
    }

}
function getVideoRotation( $videostream ) {
    if ( ! $videostream instanceof FFMpeg\FFProbe\DataMapping\Stream ) {
        throw new \Exception( 'No stream given' );
    }
    if ( ! $videostream->has( 'tags' ) ) {
        return false;
    }
    $tags = $videostream->get( 'tags' );
    if ( ! isset( $tags['rotate'] ) && $tags['rotate'] == 0 ) {
        return false;
    }

// do the rotation correction
    return $tags;
}
