<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SellerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:seller');
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
            ->with('items', Auth::user()->products);
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
}
