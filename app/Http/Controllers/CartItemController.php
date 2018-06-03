<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Notifications\OrderPinged;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;

class CartItemController extends Controller
{
    /**
     * Show the list of product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $category
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, $filter = 'all')
    {
        $title = __('app.shop.list');
        
        $items = new CartItem();
        $items = $items->with('product')
            ->with('apl')
            ->with('afa')
            ->with('author');
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where(function($query) use($q){
                return $query;
                /*->join('products AS product', 'product.id', '=', 'product_id')
                    ->join('users AS afa', 'afa.id', '=', 'afa_id')
                    ->join('users AS apl', 'afa.id', '=', 'apl_id')
                    ->join('users AS author', 'author.id', '=', 'author_id')
                    ->where('products.title', 'LIKE', '%'.$q.'%')
                    ->orWhere('products.content', 'LIKE', '%'.$q.'%')
                    ->orWhere('author.name', 'LIKE', '%'.$q.'%')
                    ->orWhere('apl.name', 'LIKE', '%'.$q.'%')
                    ->orWhere('afa.name', 'LIKE', '%'.$q.'%');
                    */
            });
        }
        
        switch($filter){
            case 'pinged':
            case 'paid':
            case 'ordered':
                $title = __('app.shop.list.status', ['status'=>__('app.'.$filter)]);
                $items = $items->where('status', $filter);
                break;
            case 'apl-not-paid':
                $items = $items->where('status', 'ordered')
                    ->whereNull('apl_paid_at');
                $title = __('app.shop.list.apl_not_paid');
                break;
            case 'apl-paid':
                $items = $items->where('status', 'ordered')
                    ->whereNotNull('apl_paid_at');
                $title = __('app.shop.list.apl_paid');
                break;
            case 'afa-not-paid':
                $items = $items->where('status', 'ordered')
                    ->whereNull('afa_paid_at');
                $title = __('app.shop.list.afa_not_paid');
                break;
            case 'afa-paid':
                $items = $items->where('status', 'ordered')
                    ->whereNotNull('afa_paid_at');
                $title = __('app.shop.list.afa_paid');
                break;
            case 'cancelled':
                $items = $items->where('status', 'ordered')
                    ->whereNotNull('cancelled_at');
                break;
            case 'all':
                $title = __('app.shop.list');
                break;
            default:
                abort(404);
        }
        
        
        $items = $items->paginate($record);
        
        return view('admin.shop.all')
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('title', $title)
            ->with('items', $items)
            ->with('breadcrumbs',$title); 
    }
    

    /**
    *  Show cart item
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\CartItem $cartitem
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request, CartItem $cartitem)
    {
        $this->middleware('auth');
        
        switch(\Auth::user()->role){
            case 'afa':
                if(!$cartitem->afa||$cartitem->afa->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.cartitem.index');
                }
                break;
            case 'apl':
                if(!$cartitem->apl||$cartitem->apl->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.cartitem.index');
                }
                break;
            case 'member':
                if(!$cartitem->author||$cartitem->author->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.cartitem.index');
                }
                break;
            case 'admin':
                $view = view('admin.cartitem.index');
                break;
            default:
                abort(404);
                break;
        }
        
        $title = __('app.cartitem.index');
        
        return $view->with('title', $title)
            ->with('item', $cartitem)
            ->with('breadcrumbs', $title);
    }
    
    

    /**
    * Pay user by role
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\CartItem $cartitem
    * @param  Mixed $role
    * @return \Illuminate\Http\Response
    */
    public function pay(Request $request,CartItem $cartitem, $role)
    {
        $action = route('admin.shop.pay', ['cartitem'=>$cartitem, 'role'=>$role]);
        
        $title = __('app.shop.pay.'.$role);
        
        return view('admin.shop.pay')
            ->with('title', $title)
            ->with('role', $role)
            ->with('action', $action)
            ->with('item', $cartitem)
            ->with('breadcrumbs', $title);
    }
    

    /**
    * Pay user by role
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\CartItem $cartitem
    * @param  Mixed $role
    * @return \Illuminate\Http\Response
    */
    public function postPay(Request $request,CartItem $cartitem, $role)
    {
        $action = view('admin.shop.pay', ['cartitem'=>$cartitem, 'role'=>$role]);
        
        $title = __('app.shop.pay.'.$role);
        
        return view('admin.shop.pay')
            ->with('title', $title)
            ->with('role', $role)
            ->with('action', $action)
            ->with('item', $cartitem)
            ->with('breadcrumbs', $title);
    }
    

    /**
    * Delete Cart Item
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\CartItem $cartitem
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request,CartItem $cartitem)
    {
        $cartitem->delete();
        return redirect()->route('admin.dashboard')
            ->with('success',"La carte a été supprimée avec succés");
    }
}
