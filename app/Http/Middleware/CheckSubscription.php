<?php

namespace App\Http\Middleware;

use Closure;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(!$request->is('*plan*')&&
           \Auth::check()&&
           !\Auth::user()->isAdmin()&&
           !\Auth::user()->onTrial()){
            return redirect()->route('plans')
                ->with('warning', __('app.trial_end'));
        }
        return $next($request);
    }
}
