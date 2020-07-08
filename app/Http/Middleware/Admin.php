<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Admin extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next ) {

        if(!auth()->user()){
            return redirect( 'login' );
        }
        if(!auth()->user()->isActive()){
            return redirect('login')->withErrors(['active' => 'Your Account has been suspended.']);
        }
        if (auth()->user()->isAdmin()) {
            return $next( $request );
        }

        return redirect( )->route('dashboard')->with( 'error', 'You have not admin access' );
    }
}
