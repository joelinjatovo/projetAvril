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
        
        return view('afa.order.all')
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
        
        return view('afa.order.all')
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
        
        return view('afa.order.all')
            ->with('title', $title)
            ->with('items', $items);
    }
    
    /*
    * Pay Commission sur vente
    */
    public function payCpc(Request $request, Order $order){
        $this->middleware('auth');
        $this->middleware('role:afa');
        
        return view('afa.cpc')->with(['item' => $order]);
    }
    
    /*
    * Pay Commission sur vente
    */
    public function postPayCpc(Request $request, Order $order){
        $this->middleware('auth');
        $this->middleware('role:afa');
        
        $this->validate($request, [
            'stripe_token' => 'required',
        ]);

        $user = \Auth::user();
        
        // Get the submitted Stripe token
        $token = $request->stripe_token;

        // If empty stripe_id then create new customer
        if (empty($user->stripe_id)) {
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
            return redirect()->route('afa.pay.cpc')
                    ->withErrors($e->getMessage())
                    ->withInput();
            }

            // Update user in the database with Stripe
            $user->stripe_id = $customer->id;
            $user->save();
        }
                
        $total    = $order->afa_amount;
        $currency = $order->currency;

        try{
            // Create the charge
            $result = \Stripe\Charge::create(array(
                "amount" => $total,
                "currency" => $currency,
                "customer" => $user->stripe_id,
                "description" => 'Commission sur presernation de clientelle'
            ));
        }catch(\Exception $e){
            return redirect()->route('afa.pay.cpc')
                ->withErrors($e->getMessage())
                ->withInput();
        }
        
        if ($result->status != 'succeeded') {
            return redirect()->route('afa.pay.cpc')
              ->with('error', "La commission sur presernation de clientelle n'a pas été éffectuée. ".$result->message);
        }
    
        $order->setAfaPaid();
        
        return redirect()->route('afa.pay.cpc')
              ->with('success', "La commission sur presernation de clientelle a été bien payée");
    }
    
}
