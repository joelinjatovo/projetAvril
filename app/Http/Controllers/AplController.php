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
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->sales()
                ->wherePivot('status', 'ordered');
        
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
                ->wherePivot('status', 'paid');
        
        return view('backend.product.all')
            ->with('title', __('app.sales'))
            ->with('items', $items);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function customers()
    {
        $items = Auth::user()->customers;
        
        return view('backend.user.all')
            ->with('title', __('app.customers'))
            ->with('items', $items);
    }
    
}
