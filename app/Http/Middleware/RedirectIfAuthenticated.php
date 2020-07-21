<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Jika ingin mengakses url login pada saat sudah
        // melakukan login, makak akan diarah ke admin
        if (Auth::guard($guard)->check()) {
            return redirect('/admin');
        }

        if (Auth::user() && Auth::user()->roles == 'ADMIN') {
            return redirect('/admin');
        }

        if (Auth::user() && Auth::user()->roles == 'USER') {
            return redirect('/kasir');
        }

        return $next($request);
    }
}
