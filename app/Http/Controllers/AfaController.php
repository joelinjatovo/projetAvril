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
        $items = Auth::user()->orders()
            ->where('status', 'ordered')
            ->paginate($this->pageSize);
        
        return view('backend.order.all')
            ->with('title', __('afa.orders'))
            ->with('items', $items);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        $items = Auth::user()->orders()
            ->where('status', 'paid')
            ->paginate($this->pageSize);
        
        return view('backend.order.all')
            ->with('title', __('afa.sales'))
            ->with('items', $items);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function commissions($filter = 'paid')
    {
        $items = \Auth::user()->orders()
            ->where(function($query){
                return $query->orWhere('status', 'ordered')
                    ->orWhere('status', 'paid');
            });
        
        switch($filter){
            case 'paid':
                $items = $items->whereNotNull('afa_paid_at');
                $title = __('app.commissions.paid');
                break;
            case 'not-paid':
                $items = $items->whereNull('afa_paid_at');
                $title = __('app.commissions.not_paid');
                break;
            default:
                abort(404);
                break;
        }
        
        $items = $items->paginate($this->pageSize);
        
        return view('backend.order.all')
            ->with('title', $title)
            ->with('items', $items);
    }
}
