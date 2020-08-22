<?php

namespace App\Http\Middleware;

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
        dd( $request->route()->parameter( 'slug' ) );

        return $next( $request );
    }
}
