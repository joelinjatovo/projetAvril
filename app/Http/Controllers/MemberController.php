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
        Auth::check();
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function showCart(Cart $cart)
    {
        return view('backend.cart.index')
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
            ->where('carts_items.status', 'pinged')
            ->get();
        return view('backend.product.all')
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
            ->where('carts_items.status', 'paid')
            ->get();
        return view('backend.product.all')
                ->with('items', $items);
    }
}
