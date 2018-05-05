<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;
use App;
use Carbon\Carbon;

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
            Carbon::setLocale(Session::get('locale'));
        }elseif(Auth::check()&&Auth::user()->language){
            Session::put('locale',Auth::user()->language);
            App::setLocale(Session::get('locale'));
            Carbon::setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
