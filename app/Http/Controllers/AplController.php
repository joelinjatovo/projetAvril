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
        $items = Auth::user()->orders()
            ->where('status', 'ordered')
            ->paginate($this->pageSize);
        
        return view('backend.sale.all')
            ->with('title', __('apl.orders'))
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
        
        return view('backend.sale.all')
            ->with('title', __('apl.sales'))
            ->with('items', $items);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function customers()
    {
        $items = Auth::user()->customers()
            ->paginate($this->pageSize);
        
        return view('backend.user.all')
            ->with('title', __('app.customers'))
            ->with('items', $items);
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function commissions($filter = 'paid')
    {
        $items = Auth::user()->orders()
            ->where('status', 'ordered');
        
        switch($filter){
            case 'paid':
                $items = $items->where('apl_paid_at', '<>', 'NULL');
                $title = __('app.commissions.paid');
                break;
            case 'not-paid':
                $items = $items->where('apl_paid_at', 'NULL');
                $title = __('app.commissions.not_paid');
                break;
            default:
                abort(404);
                break;
        }
        
        $items = $items->paginate($this->pageSize);
        
        return view('backend.sale.all')
            ->with('title', $title)
            ->with('items', $items);
    }
    
}
