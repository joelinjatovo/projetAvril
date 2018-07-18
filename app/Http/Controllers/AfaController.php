<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Order;

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
            case 'received':
                $items = $items->whereNotNull('tma_paid_at'); // Commission sur vente recues
                $title = __('afa.commissions.received');
                break;
            case 'not-received':
                $items = $items->whereNull('tma_paid_at'); // Commission sur vente non recues
                $title = __('afa.commissions.not-received');
                break;
            case 'paid':
                $items = $items->whereNotNull('afa_paid_at'); // Commision de presentation de clientelle payée
                $title = __('afa.commissions.paid');
                break;
            case 'not-paid':
                $items = $items->whereNull('afa_paid_at'); // Mais Commision de presentation de clientelle non payée
                $title = __('afa.commissions.not-paid');
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
    
    public function postAction(Request $request, Order $order){
        $this->middleware('auth');
        $this->middleware('role:afa');
        $this->validate($request, ['action'=>'required']);
        $action = $request->action;
        switch($action){
            case 'pay-cpc':
                return $this->payCpc($request, $order);
        }
    }
    
    /*
    * Cancelling order
    */
    private function payCpc(Request $request, Order $order){
        $order->setAfaPaid();
        return redirect()->route('profile')
            ->with('success', "La commission a bien été payée.");
    }
    
}
