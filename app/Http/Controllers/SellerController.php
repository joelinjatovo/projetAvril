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
    }
    
    /**
     * List of products
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $items = Auth::user()->products;
        
        return view('backend.product.all')
            ->with('title', __('app.products'))
            ->with('items', $items);
    }
    
    /**
     * List of ordered products
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->products
            ->where('products.status', 'ordered');
        
        return view('backend.product.all')
            ->with('title', __('app.orders'))
            ->with('items', $items);
    }
    
    /**
     * List of sale products
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        $items = Auth::user()->products
            ->where('products.status', 'paid');
        
        return view('backend.product.all')
            ->with('title', __('app.sales'))
            ->with('items', $items);
    }
    
}
