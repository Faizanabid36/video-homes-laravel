<?php

namespace App\Http\Middleware;

use App\Page;
use App\User;
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

        $user = User::whereUsername($request->route()->parameter( 'slug' ));
        if ( $user->count()) {
            return $next( $request );
        }

        return abort( 404 );

    }
}
