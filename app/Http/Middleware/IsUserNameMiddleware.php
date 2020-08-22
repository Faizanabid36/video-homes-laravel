<?php

namespace App\Http\Middleware;

use App\Page;
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
        $page = Page::viewPage( $request->route()->parameter( 'slug' ) );
        if($page->count() > 0) {
            $page = $page->first();
            $request->merge(compact('page'));
            return $next( $request );
        }

        $video = Video::userVideos( $request->route()->parameter( 'slug' ), $request->route()->parameter( 'video_id' ) );
        if ( $video->count() > 0 ) {
            $video = $video->first();
            $request->merge(compact('video'));
            return $next( $request );
        }

        return abort( 404 );

    }
}
