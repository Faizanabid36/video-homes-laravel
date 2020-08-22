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
            $page = $page->first();
            $request->merge(compact('page'));
            return $next( $request );
        }
        return app(IsUserNameMiddleware::class)->handle($request, function ($request) use ($next) {
            return $next($request);
        });

    }
}
