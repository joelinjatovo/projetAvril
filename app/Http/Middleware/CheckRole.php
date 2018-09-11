<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!\Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!\Auth::user()->hasRole($role)) {
            abort(401);
        }
        
        return $next($request);
    }
}
