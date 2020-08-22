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
        dd(request()->route()->parameters());
        return redirect()->route('directory_by_username',request()->route()->parameters());

    }
}
