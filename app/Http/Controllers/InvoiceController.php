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
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Show the list of product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $category
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, User $user)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $title = __('app.invoice.list');
        
        $items = $user->orders()->where(function($query){
                    return $query->where('status', 'ordered')
                        ->orWhere('status', 'paid');
                });
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where(function($query) use($q){
                return $query;
            });
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
                    $view = view('backend.invoice.index');
                }
                break;
            case 'apl':
                if(!$order->apl||$order->apl->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.invoice.index');
                }
                break;
            case 'member':
                if(!$order->author||$order->author->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.invoice.index');
                }
                break;
            case 'seller':
                if(!$order->product||!$order->product->seller||$order->product->seller->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.invoice.index');
                }
                break;
            case 'admin':
                $view = view('admin.invoice.index');
                break;
            default:
                abort(404);
                break;
        }
        
        $title = __('app.invoice.index');
        
        return $view->with('title', $title)
            ->with('item', $order)
            ->with('breadcrumbs', $title);
    }
}
