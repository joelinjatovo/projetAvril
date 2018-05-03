<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AplController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:apl');
        Auth::check();
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        return view('backend.product.all')
            ->with('items', Auth::user()->selledProducts);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function clients()
    {
        return view('backend.user.all')
            ->with('items', Auth::user()->clients);
    }
    
}
