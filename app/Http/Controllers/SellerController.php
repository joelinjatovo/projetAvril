<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Order;

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
     * Liste des produits du vendeur
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $items = Auth::user()->products()
            ->paginate($this->pageSize);
        
        return view('seller.product.all')
            ->with('title', __('seller.products'))
            ->with('items', $items);
    }
    
    /**
     * Listes des produits en cours de vente
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $items = Auth::user()->products()
            ->where('products.status', 'ordered')
            ->paginate($this->pageSize);
        
        return view('seller.product.all')
            ->with('title', __('seller.orders'))
            ->with('items', $items);
    }
    
    /**
     * Listes des produits vendus
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        $items = Auth::user()->products()
            ->where('products.status', 'paid')
            ->paginate($this->pageSize);
        
        return view('seller.product.all')
            ->with('title', __('seller.sales'))
            ->with('items', $items);
    }
    
    /**
     * Listes des produits confirmer
     *
     * @return \Illuminate\Http\Response
     */
    public function toConfirm()
    {
        $items = \Auth::user()->orders()
            ->where('status', 'ordered')
            ->whereNotNull('reserved_at')
            ->whereNull('confirmed_at')
            ->paginate($this->pageSize);
        
        return view('seller.order.all')
            ->with('title', __('seller.orders.to-confirm'))
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
            ->whereNotNull('reserved_at')
            ->whereNotNull('confirmed_at')
            ->where(function($query){
                return $query->orWhere('status', 'ordered')
                    ->orWhere('status', 'paid');
            });
        
        switch($filter){
            case 'paid':
                $items = $items->whereNotNull('tma_paid_at');
                $title = __('seller.commissions.paid');
                break;
            case 'not-paid':
                $items = $items->whereNull('tma_paid_at');
                $title = __('seller.commissions.not-paid');
                break;
            default:
                abort(404);
                break;
        }
        
        $items = $items->paginate($this->pageSize);
        
        return view('seller.order.all')
            ->with('title', $title)
            ->with('items', $items);
    }
    
    public function postAction(Request $request, Order $order){
        $this->middleware('auth');
        $this->middleware('role:seller');
        $this->validate($request, ['action'=>'required']);
        $action = $request->action;
        switch($action){
            case 'confirm':
                return $this->confirmOrder($request, $order);
            case 'pay-tma':
                return $this->payTma($request, $order);
            case 'cancel':
                return $this->cancelOrder($request, $order);
        }
    }
    
    /*
    * Cancelling order
    */
    private function cancelOrder(Request $request, Order $order){
        $order->setAsCancelled();
        return redirect()->route('profile')
            ->with('success', "La commande a bien été annulée.");
    }
    
    /*
    * Confirm order
    */
    private function confirmOrder(Request $request, Order $order){
        $order->setAsConfirmed();
        return redirect()->route('profile')
            ->with('success', "La commande a bien été confirmée.");
    }
    
    /*
    * Pay afa
    */
    private function payTma(Request $request, Order $order){
        $order->setTmaPaid();
        return redirect()->route('profile')
            ->with('success', "La commande a bien été confirmée.");
    }
    
}
