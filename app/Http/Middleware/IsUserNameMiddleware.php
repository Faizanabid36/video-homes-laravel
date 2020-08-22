<?php

namespace App\Http\Middleware;

use App\Video;
use Closure;

class IsUserNameMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle( $request, Closure $next ) {
//        dd($request->route()->parameter( 'video_id' ) );
        $video = Video::userVideos( $request->route()->parameter( 'slug' ), $request->route()->parameter( 'video_id' ) );
        dd($video->first()->toArray());
        if ( $video->count() > 0 ) {
            return $next( $request );
        }
        return abort( 404 );

    }
}
