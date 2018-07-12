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
     * Liste des produits du vendeur
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        $items = Auth::user()->products()
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
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
        
        return view('backend.product.all')
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
        
        return view('backend.product.all')
            ->with('title', __('seller.sales'))
            ->with('items', $items);
    }
    
    /*
    * Cancelling order
    */
    public function cancelOrder(Request $request, Order $order){
        $this->middleware('auth');
        $this->middleware('role:seller');
    
        $order->setAsCancelled();
        
        return redirect()->route('profile')
            ->with('success', "La commande a bien été annulée.");
    }
    
    /*
    * Confirm order
    */
    public function confirmOrder(Request $request, Order $order){
        $this->middleware('auth');
        $this->middleware('role:seller');
    
        $order->setAsConfirmed();
        
        return redirect()->route('profile')
            ->with('success', "La commande a bien été confirmée.");
    }
    
}
