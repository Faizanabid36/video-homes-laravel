<?php

namespace App\Libs;

use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use \Illuminate\Support\Facades\File;

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
if ( ! function_exists( 'getCleanFileName' ) ) {
    function getCleanFileName( $filename, $suffix ): string {
        return preg_replace( '/\\.[^.\\s]{3,4}$/', '', $filename ) . $suffix;
    }
}
