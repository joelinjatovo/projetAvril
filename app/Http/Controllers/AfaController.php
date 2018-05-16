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
    }
    
    /**
     * Render view with list of ordered products
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->sales()
            ->wherePivot('status', 'ordered')
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.orders'))
            ->with('items', $items);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        $items = Auth::user()->sales()
            ->wherePivot('status', 'paid')
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.sales'))
            ->with('items', $items);
    }
}
