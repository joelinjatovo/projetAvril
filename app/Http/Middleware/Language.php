<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;
use App;

class Language
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
        if(Session::has('locale')){
            App::setLocale(Session::get('locale'));
        }elseif(Auth::check()&&Auth::user()->language){
            Session::put('locale',Auth::user()->language);
            App::setLocale(Auth::user()->language);
        }
        return $next($request);
    }
}
