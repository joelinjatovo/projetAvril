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
    public function showOrder(Order $order)
    {
        return view('backend.order.index')
                ->with('item', $order);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->orders()->ofStatus('pinged')->get();
        return view('backend.order.all')
                ->with('items', $items);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function purchases()
    {
        $items = Auth::user()->orders()->ofStatus('payed')->get();
        return view('backend.order.all')
                ->with('items', $items);
    }
}
