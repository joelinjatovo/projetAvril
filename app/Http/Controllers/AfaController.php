<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AfaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:afa');
        Auth::check();
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        return view('backend.product.all')
            ->with('items', Auth::user()->sales);
    }
}
