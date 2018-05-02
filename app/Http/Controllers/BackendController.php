<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Auth::check();
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('backend.dashboard.'.Auth::user()->role);
    }

    /**
     * Show form and edit current user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $action = url(Auth::user()->role.'/edit');
        return view('backend.user.update')
            ->with('action',$action)
            ->with('item',Auth::user());
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function starred()
    {
        return view('backend.product.all')
            ->with('items', Auth::user()->starredProducts);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function saved()
    {
        return view('backend.product.all')
            ->with('items', Auth::user()->savedProducts);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function order($filter='pinged')
    {
        if($filter=='pinged'){
            $items = Auth::user()->orders->ofStatus('pinged');
        }else if($filter=='payed'){
            $items = Auth::user()->orders->ofStatus('payed');
        }else{
            abort(404);
        }
        return view('backend.product.all')
                ->with('items', $items);
    }
}
