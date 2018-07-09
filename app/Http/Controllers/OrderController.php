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
                $title = __('app.shop.list.apl_not_paid');
                break;
            case 'apl-paid':
                $items = $items->where(function($query){
                    return $query->where('status', 'ordered')
                        ->orWhere('status', 'paid');
                })->whereNotNull('apl_paid_at');
                $title = __('app.shop.list.apl_paid');
                break;
            case 'afa-not-paid':
                $items = $items->where('status', 'ordered')
                    ->whereNull('afa_paid_at');
                $title = __('app.shop.list.afa_not_paid');
                break;
            case 'afa-paid':
                $items = $items->where(function($query){
                    return $query->where('status', 'ordered')
                        ->orWhere('status', 'paid');
                })->whereNotNull('afa_paid_at');
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
                    $view = view('backend.cartitem.index');
                }
                break;
            case 'apl':
                if(!$order->apl||$order->apl->id!=\Auth::user()->id){
                    abort(404);
                }else{
                    $view = view('backend.cartitem.index');
                }
                break;
            case 'member':
                if(!$order->author||$order->author->id!=\Auth::user()->id){
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
    * @param  \App\Models\Order $order
    * @param  Mixed $role
    * @return \Illuminate\Http\Response
    */
    public function pay(Request $request, Order $order, $role)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if(($order->status!='ordered')||!$order->product||!$order->apl||!$order->afa){
            abort(404);
        }
        
        switch($role){
            case 'apl':
                if(!empty($order->apl_paid_at)){
                    abort(404);
                }
                $user = $order->apl;
                break;
            case 'afa':
                if(!empty($order->afa_paid_at)){
                    abort(404);
                }
                $user = $order->afa;
                break;
            default:
                abort(404);
                break;
        }
        
        $action = route('admin.order.pay', ['order'=>$order, 'role'=>$role]);
        $title = __('app.order.pay.'.$role);
        return view('admin.shop.pay')
            ->with('title',   $title)
            ->with('role',    $role)
            ->with('action',  $action)
            ->with('item',    $order)
            ->with('user',    $user)
            ->with('breadcrumbs', $title);
    }

    /**
    * Pay user by role
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Order $order
    * @param  Mixed $role
    * @return \Illuminate\Http\Response
    */
    public function postPay(Request $request, Order $order, $role)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if(($order->status!='ordered')||!$order->product||!$order->apl||!$order->afa){
            abort(404);
        }
        
        switch($order){
            case 'apl':
                if(!empty($order->apl_paid_at)){
                    abort(404);
                }
                $user = $order->apl;
                $percent = option('payment.percent_presentation_apl', 0.01);
                $amount = $order->tma*$percent;
                break;
            case 'afa':
                if(!empty($order->afa_paid_at)){
                    abort(404);
                }
                $user = $order->afa;
                $percent = option('payment.percent_presentation_afa', 0.01);
                $amount = $order->tma*$percent;
                break;
            default:
                abort(404);
                break;
        }
        
        $action = route('admin.order.pay', ['order'=>$order, 'role'=>$role]);

        $token = $request->input('stripe_token');
        
        // If empty stripe_id then create new customer
        if (empty($user->strip_id)) {
            // Create a new Stripe customer
            try {
                $customer = \Stripe\Customer::create([
                'source' => $token,
                'email' => $user->email,
                'metadata' => [
                    "First Name" => $user->name,
                    "Last Name" => $user->name
                ]
                ]);
            } catch (\Stripe\Error\Card $e) {
                return redirect()->to($action)
                    ->withErrors($e->getMessage())
                    ->withInput();
            }

            // Update user in the database with Stripe
            $user->stripe_id = $customer->id;
            $user->save();
            
        }

        // Charging the Customer with the selected amount
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'eur',
                'customer' => $user->stripe_id,
                'metadata' => [
                    'product_name' => $order->product?$order->product->title:'unknown product'
                ]
                ]);
        } catch (\Stripe\Error\Card $e) {
            return redirect()->to($action)
                ->withErrors($e->getMessage())
                ->withInput();
        }

        // Update cartitem record in the database
        switch($role){
            case 'apl':
                $order->apl_paid_at = date('Y-m-d h:i:s');
                $order->apl_ammount = $amount;
                $order->apl_transaction_id = $charge->id;
                $order->apl_payment_type = 'stripe';
                $order->save();
                break;
            case 'afa':
                $order->afa_paid_at = date('Y-m-d h:i:s');
                $order->afa_ammount = $amount;
                $order->afa_transaction_id = $charge->id;
                $order->afa_payment_type = 'stripe';
                $order->save();
                break;
        }
        
        // Notify APL or AFA
        $user->notify(new OrderPaid($user, $order));
        
        // Update cartitem record status
        if(!empty($order->apl_paid_at)&&!empty($order->afa_paid_at)){
            $order->status = 'paid';
            $order->save();
            
            // Notify Customer
            if($order->author){
                $order->author->notify(new OrderPaid($admin, $order));
            }
        }
        
        // Notify Admin
        $adminId = option('site.admin', 1);
        $admin = User::find($adminId);
        if($admin){
            $admin->notify(new OrderPaid($admin, $order));
        }
        
        return redirect()->route('admin.dashboard')
            ->with('success',"L'agence a été bien payé avec succés.");
    }
    
    /**
    * Delete Cart Item
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Order $order
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Order $order)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $order->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"La carte a été supprimée avec succés");
    }
}
