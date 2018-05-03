<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:member');
        Auth::check();
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
            $items = Auth::user()->orders()->ofStatus('pinged')->get();
        }else if($filter=='payed'){
            $items = Auth::user()->orders()->ofStatus('payed')->get();
        }else{
            abort(404);
        }
        return view('backend.product.all')
                ->with('items', $items);
    }
}
