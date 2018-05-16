<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Order;

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
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function showCart(Cart $cart)
    {
        return view('backend.cart.index')
            ->with('title', __('app.cart'))
            ->with('item', $cart);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->purchases()
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
    public function purchases()
    {
        $items = Auth::user()->purchases()
            ->wherePivot('status', 'paid')
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.purchases'))
            ->with('items', $items);
    }
}
