<?php


use App\VideoView;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;

if ( ! function_exists( 'dashboardChart' ) ) {
    function dashboardChart( $labels, $label, $data, $showBorder ) {
        $Data    = [];
        $Data['labels']    = $labels;
        $datasets['data']  = $data;
        $datasets['label'] = $label;
        if ( $showBorder ) {
            $datasets['backgroundColor'] = [
                'rgb(255, 102, 102)',
                'rgb(209, 71, 163)'
            ];
            $datasets['borderColor']     = [
                'rgb(255, 102, 102)',
                'rgb(209, 71, 163)'
            ];
            $datasets['borderWidth']     = 2;
        }
        $Data['datasets'] = [ $datasets ];

        return $Data;
    }
}

if ( ! function_exists( 'saveVideoByResolution' ) ) {
    function saveVideoByResolution( $path, $width, $height, $bitrate = '500' ) {
        // set the quality
        $savePath         = getCleanFileName( $path, "_${height}p_converted.mp4" );
        $video            = \FFMpeg::open( $path );
        $lowBitrateFormat = ( new X264( 'aac', 'libx264' ) )->setKiloBitrate( $bitrate );
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
//libmp3lame
if ( ! function_exists( 'saveVideoStream' ) ) {
    function saveVideoStream( $path, $width, $height, $bitrate = '500' ) {
        // set the quality
        $savePath         = getCleanFileName( $path, "_${height}p_converted.mp4" );
        $video            = \FFMpeg::open( $path );
        $lowBitrateFormat = ( new X264( 'aac', 'libx264' ) )->setKiloBitrate( $bitrate );
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
    function generateThumbnailsFromVideo( $media, $path, $angle, $thumbnail_shots = 3 ) {
        $thumbnail_shots = $media->getDurationInSeconds() >= $thumbnail_shots ? $thumbnail_shots : 1;
        $divide_result   = (int) floor( $media->getDurationInSeconds() / $thumbnail_shots );
        $seconds         = $divide_result;
        $newThumbnail    = [];
        for ( $i = 1; $i <= $thumbnail_shots; $i ++ ) {
            $newThumbnail[ $i ] = str_replace( "." . request()->video->getClientOriginalExtension(), "-$i.png", $path );
            $media->getFrameFromSeconds( $seconds )->export()->save( $newThumbnail[ $i ] );
            if ( $angle ) {
                $imageUpdate = storage_path( "app/public/${newThumbnail[ $i ]}" );
                imagepng( imagerotate( imagecreatefrompng( $imageUpdate ), $angle, 0 ), $imageUpdate );
            }

            $seconds += $divide_result;
        }

        return $newThumbnail;
    }

}
function getVideoRotation( $videostream ) {
    if ( ! $videostream instanceof FFMpeg\FFProbe\DataMapping\Stream ) {
        return false;
    }
    if ( ! $videostream->has( 'tags' ) ) {
        return false;
    }
    $tags = $videostream->get( 'tags' );
    if ( ! isset( $tags['rotate'] ) || $tags['rotate'] == 0 ) {
        return false;
    }

// do the rotation correction
    return $tags['rotate'];
}


function sortVideosInOrder( $order, $videos ) {
    switch ( $order ) {
        case 'created_at':
            return collect( $videos )->map( function ( $video ) {
                $v     = VideoView::getTotalVideoViews( $video );
                $views = ! is_null( $v ) ? $v : 0;

                return collect( $video )->merge( [
                    'views'   => $views,
                    'daysAgo' => $video->created_at->diffForHumans()
                ] );
            } )->sortBy( 'created_at' )->values();
            break;
        case 'views':
            return collect( $videos )->map( function ( $video ) {
                $v     = VideoView::getTotalVideoViews( $video );
                $views = ! is_null( $v ) ? $v : 0;

                return collect( $video )->merge( [
                    'views'   => $views,
                    'daysAgo' => $video->created_at->diffForHumans()
                ] );
            } )->sortByDesc( 'views' )->values();
            break;
        case 'title':
            return collect( $videos )->map( function ( $video ) {
                $v     = VideoView::getTotalVideoViews( $video );
                $views = ! is_null( $v ) ? $v : 0;

                return collect( $video )->merge( [
                    'views'   => $views,
                    'daysAgo' => $video->created_at->diffForHumans()
                ] );
            } )->sortBy( 'title' )->values();
            break;
        default:
            return collect( $videos )->map( function ( $video ) {
                $v     = VideoView::getTotalVideoViews( $video );
                $views = ! is_null( $v ) ? $v : 0;

                return collect( $video )->merge( [
                    'views'   => $views,
                    'daysAgo' => $video->created_at->diffForHumans()
                ] );
            } );
            break;
    }
}

function level_generator( $albums, $key ) {
    $rv = array();
    foreach ( $albums as &$album ) {

        if ( is_null( $album[ $key ] ) ) {
            // no parentId -> entry in the root array
            $rv[] = &$album;
        } else {
            $pid = $album[ $key ];
            if ( ! isset( $albums[ $pid ] ) ) {
                echo 'orphant album: ', $album['id'], "\n";
            } else {
                if ( ! isset( $albums[ $pid ]['children'] ) ) {
                    $albums[ $pid ]['children'] = array();
                }
                $albums[ $pid ]['children'][] = &$album;
            }
        }
    }

    return $rv;
}

function convertToTree( $flat, $idField = 'id', $parentIdField = 'parent_id', $childNodesField = 'childNodes' ) {
    $indexed = array();
    // first pass - get the array indexed by the primary id
    foreach ( $flat as $row ) {
        $indexed[ $row[ $idField ] ]                     = $row;
        $indexed[ $row[ $idField ] ][ $childNodesField ] = array();
    }

    //second pass
    $root = null;
    foreach ( $indexed as $id => $row ) {
        $indexed[ $row[ $parentIdField ] ][ $childNodesField ][ $id ] =& $indexed[ $id ];
        if ( ! $row[ $parentIdField ] ) {
            $root = $id;
        }
    }

    return array_values( array( $root => $indexed[ $root ] ) );
}

function buildTree( array &$elements, $parentId = null ) {
    $branch = array();

    foreach ( $elements as $element ) {
        if ( $element['parent_id'] == $parentId ) {
            $children = buildTree( $elements, $element['id'] );
            if ( $children ) {
                $element['childNodes'] = $children;
            }
            $branch[ $element['id'] ] = $element;
            unset( $elements[ $element['id'] ] );
        }
    }

    return $branch;
}

$data = [];
function grabUsers( $categories, $forceClear = false ) {
    global $data;

    if ( $forceClear ) {
        $categories = [ $categories ];
        $data       = [];
    }

    foreach ( $categories as $val ) {
        if ( isset( $val['list'] ) && ! empty( $val['list'] ) ) {
            foreach ( $val['list'] as $user ) {
                $user                           = is_array($user) ? $user : $user->toArray();
                if($user['user_id']){
                    $data[ $user['user_id']['id'] ] = collect( $user['user_id'] )->merge( collect($user)->except('user_id') )->toArray();
                }


            }
        }
        if ( isset( $val['children'] ) && ! empty( $val['children'] ) ) {
            grabUsers( $val['children'] );
        }
    }

    return $data ? array_values( $data ) : [];
}
function userMerger($categories){
    $d = [];

    foreach ( $categories as $val ) {
        if ( isset( $val['list'] ) && ! empty( $val['list'] ) ) {
            foreach ( $val['list'] as $user ) {
                $user = is_array( $user ) ? $user : $user->toArray();
                if ( isset($user['user_id']) && !is_null($user['user_id']) ) {
                    die("yes");
                    $d[ $user['user_id']['id'] ] = collect( $user['user_id'] )->merge( collect( $user )->except( 'user_id' ) )->toArray();
                }
            }
        }
    }
    return $d;
}
