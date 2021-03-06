<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Notifications\NewOrder;
use App\Notifications\OrderPaid;

use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;

class OrderController extends Controller
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
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $title = __('app.shop.list');
        
        $items = new Order();
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
                $title = __('admin.commissions.not-paid');
                break;
            case 'apl-paid':
                $items = $items->where(function($query){
                    return $query->where('status', 'ordered')
                        ->orWhere('status', 'paid');
                })->whereNotNull('apl_paid_at');
                $title = __('admin.commissions.not-paid');
                break;
            case 'afa-not-received':
                $items = $items->where('status', 'ordered')
                    ->whereNull('afa_paid_at');
                $title = __('admin.commissions.not-received');
                break;
            case 'afa-received':
                $items = $items->where(function($query){
                    return $query->where('status', 'ordered')
                        ->orWhere('status', 'paid');
                })->whereNotNull('afa_paid_at');
                $title = __('admin.commissions.not-received');
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
        
        return view('admin.order.all')
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
    * @param  \App\Models\Order $order
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request, Order $order)
    {
        $this->middleware('auth');
        
        switch(\Auth::user()->role){
            case 'afa':
                if(!$order->afa||$order->afa->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.order.index');
                }
                break;
            case 'apl':
                if(!$order->apl||$order->apl->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.order.index');
                }
                break;
            case 'member':
                if(!$order->author||$order->author->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.order.index');
                }
                break;
            case 'seller':
                if(!$order->product||!$order->product->seller||$order->product->seller->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.order.index');
                }
                break;
            case 'admin':
                $view = view('admin.order.index');
                break;
            default:
                abort(404);
                break;
        }
        
        $title = __('app.order.index');
        
        return $view->with('title', $title)
            ->with('item', $order)
            ->with('breadcrumbs', $title);
    }

    /**
    * Handle post action
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Order $order
    * @return \Illuminate\Http\Response
    */
    public function postAction(Request $request, Order $order)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $this->validate($request, ['action'=>'required']);
        
        $action = $request->action;
        switch($action){
            case 'delete':
                return $this->delete($request, $order);
            case 'cancel':
                return $this->cancel($request, $order);
            case 'pay-apl':
                return $this->payApl($request, $order);
            default:
                abort(404);
                break;
        }
    }

    /**
    * Pay APL Commision MIO
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Order $order
    * @return \Illuminate\Http\Response
    */
    private function payApl(Request $request, Order $order)
    {
        $order->setAplPaid();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"La commission MIO a été payée avec succés");
    }

    /**
    * Cancel Order
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Order $order
    * @return \Illuminate\Http\Response
    */
    private function cancel(Request $request, Order $order)
    {
        $order->setAsCancelled();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"La commande a été annulée avec succés");
    }

    /**
    * Delete Order
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Order $order
    * @return \Illuminate\Http\Response
    */
    private function delete(Request $request, Order $order)
    {
        $order->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"La commande a été supprimée avec succés");
    }
}
