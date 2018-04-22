<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Order;

class OrderController extends Controller
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
     * @param  App\Models\Order  $order
     * @return Illuminate\Http\Response
     */
    public function index(Request $request, Order $order)
    {
        return view('admin.order.index', ['item'=>$order]);
    }
    
    /**
     * Show the list of page.
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
        if(!$page) $page =1;
        
        $items = Order::paginate($this->pageSize);
        return view('admin.order.all', compact('items', 'filter', 'page')); 
    }
}
