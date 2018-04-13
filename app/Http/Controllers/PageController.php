<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Show the static page config.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
    	$items = Page::get();
        return view('page.all', compact('items'));
    }


}
