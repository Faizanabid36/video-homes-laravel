<?php

namespace App\Http\Middleware;

use App\Page;
use Closure;

class IsPageMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle( $request, Closure $next ) {
        //dd( $request->route()->parameter( 'slug' ) );
        $page = Page::viewPage( $request->route()->parameter( 'slug' ) );
        if($page->count() > 0) {
            $request->merge(compact('page'));
            return $next( $request );
        }

    }
}
