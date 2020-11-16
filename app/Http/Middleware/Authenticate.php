<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle( $request, Closure $next , ...$guards) {
        if(!auth()->user()){
            return redirect()->route('login');
        }
        if(!auth()->user()->isActive()){
            Auth::logout();
            return redirect()->route('login')->withErrors(['active' => 'Your Account has been suspended.']);
        }

        if ( auth()->user()->isUser() ) {
            return $next( $request );
        }

        return redirect()->route('admin_panel')->with( 'error', 'You have no user rights' );
    }
}
