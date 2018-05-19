<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show a order info
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Cart  $cart
     * @return Illuminate\Http\Response
     */
    public function index(Request $request, Cart $cart)
    {
        return view('admin.cart.index', ['item'=>$cart]);
    }
    
    /**
     * Show the list of cart.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function allAdmin(Request $request, $filter='all')
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $page = $request->get('page');
        if(!$page) $page = 1;
        
        switch($filter){
            case 'pinged':
            case 'paid':
            case 'ordered':
                $items = Cart::where('status', $filter)
                    ->paginate($this->pageSize);
                break;
            case 'all':
                $items = Cart::paginate($this->pageSize);
                break;
            default:
                abort(404);
        }
        return view('admin.cart.all', compact('items', 'filter', 'page')); 
    }
}
