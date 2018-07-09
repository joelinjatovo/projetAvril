<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;
use App\Models\Type;
use App\Models\State;
use App\Models\Search;

class ShopController extends Controller
{
    /**
     * Show the list of product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $category
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category = null)
    {
        $items = Product::ofStatus('published')
                ->where('quantity', '>', 0);
        
        if($category&&$category->id>0){
            $items = $items->where("category_id", $category->id);
        }
        
        $search = new Search();
        $q = $request->q;
        if($q){
            $items = $items->where(function($query) use ($q){
                return $query->where('content', 'LIKE', '%'.$q.'%')
                    ->orWhere('title', 'LIKE', '%'.$q.'%');
            });
            $search->keyword = $q;
            $search->save();
        }
        
        $page = $request->get('page');
        if(empty($page)) $page = 1;
        
        $orderBy = $request->get('orderBy');
        if(!in_array($orderBy, ['price', 'created_at', 'view_count'])) $orderBy = 'price';
        
        $order = $request->get('order');
        if(!in_array($order, ['desc', 'asc'])) $order = 'desc';
        
        $items = $items->orderBy($orderBy, $order);
        $items = $items->paginate($this->pageSize);
        
        if($request->ajax()){
            return response()->json(array(
                'html' => view('ajax.product.all', compact('items'))->render()
            ));
        }
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page2 = Page::where('path', '=', '/products*')->first();
        if($page2){$pubs = $page2->pubs;}else{$pubs=[];}

        $types = Type::orderBy('title', 'asc')
            ->where('object_type', 'type')
            ->withCount('products')
            ->get();
        
        $locationTypes = Type::orderBy('title', 'asc')
            ->where('object_type', 'location')
            ->withCount('products')
            ->get();
        
        $states = State::orderBy('content', 'asc')
            ->withCount('products')
            ->get();
        
        return view('shop.index')
            ->with('items', $items)
            ->with('search', $search)
            ->with('q', $q)
            ->with('orderBy', $orderBy)
            ->with('order', $order)
            ->with('page', $page)
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('types', $types)
            ->with('locationTypes', $locationTypes)
            ->with('states', $states)
            ->with('category', $category)
            ->with('categories', $categories); 
    }
    
    /**
     * Select Apl for an product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function apl(Request $request, Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $distance = $request->get('distance');
        if(empty($distance)) $distance = 100;
        
        $data = [];
        if($product && $product->id>0){
            if(!$product->isDisponible()){
               return redirect()->route('product.index', $product)
               ->withInput()->with('error', "Ce produit n'est plus disponible.");
            }

            if(!$product->location){
               return redirect()->route('product.index', $product)
                    ->with('error','Le systeme ne peut pas localiser le produit');
            }
            
            $data[] = [
              'id' => $product->id,
              'lat' => $product->location?$product->location->latitude:0,
              'lng' => $product->location?$product->location->longitude:0,
              'title' => $product->title,
              'type' => 'product',
            ];
        }
        
        $apls = User::ofRole('apl')
            ->isActive()
            ->has('location')
            ->with('location')
            ->get();
        
        $userApl = Auth::user()->apl;
        
        $selected = null;
        
        foreach($apls as $item){
            $dataTemp = [
              'id' => $item->id,
              'lat' => $item->location?$item->location->latitude:0,
              'lng' => $item->location?$item->location->longitude:0,
              'title' => $item->name,
              'content' => $item->get_meta('orga_description')?$item->get_meta('orga_description')->value:'',
              'type' => $item->role,
            ];
            
            $data[] = $dataTemp;
            
            if($userApl && ($item->id == $userApl->id)){
                $selected = $dataTemp;
            }
        }
        
        $action = route('shop.select.apl', $product);
    	return view('backend.apl.select')
            ->with('action', $action)
            ->with('location', Auth::user()->location)
            ->with('items', $apls)
            ->with('item', $product)
            ->with('distance', $distance)
            ->with('distances', $this->distances)
            ->with('selected', json_encode($selected))
            ->with('data', json_encode($data));
    }
    
    /**
     * Select an apl
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function postApl(Request $request, Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $apl = User::ofRole('apl')
            ->isActive()
            ->where('id', '=', $request->apl)
            ->first();
        
        if(!$apl){
    	   return redirect()
               ->route('shop.select.apl', $product)
               ->withInput()
               ->with('error','Vous devez choisir un apl avant de reserver un produit.');
        }
        
        // Update User's APL
        \Auth::user()->apl_id = $apl->id;
        \Auth::user()->save();
        
        return $this->order($request, $product);
    }
    
    /**
     * Order product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request, Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');

        // Get AFA
        /*
        if($product->location){
            $afas = User::ofRole('afa')->isActive()
                ->hasLocation()->get();
            
            $dists = [];
            $value = 10000000000;
            foreach($afas as $item){
                if($item->location){
                    $dist = $product->location->getDistance($item->location);
                    if($dist<=$value){
                        $value = $dist;
                        $afa = $item;
                    }
                }
            }
        }
        
        if(!isset($afa) || $afa->id==0){
    	   return redirect()->route('product.index', $product)
               ->withInput()
               ->with('error','Vous ne pouvez pas encore faire cet achat. Il n\'y a pas d\'agence dans la base');
        }
        */
        
        
        // Check if product is disponible
        if(!$product->isDisponible()){
    	   return redirect()
               ->route('product.index', $product)
               ->withInput()->with('error', "Ce produit n'est plus disponible.");
        }
        
        // Check if user have selected an APL
        if(!\Auth::user()->hasApl()){
    	   return redirect()
               ->route('shop.select.apl', $product)
               ->withInput()
               ->with('error','Vous devez choisir un apl avant de reserver un produit.');
        }
        
        // Get selected APL
        $apl = Auth::user()->apl;
        
        // Montant de reservation du produit
        $reservation = max(option('payment.amount_of_reservation'), $product->reservation);
        if($reservation<=0){
    	   return redirect()
               ->route('product.index', $product)
               ->withInput()->with('error', 'Le montant de reservation ne paut pas etre zero.');
        }
        
        // Save order in database
        $order = Order::add($product, $apl, $reservation);

        // Put it in session
    	Session::put('order', $order);
    	Session::save();

        // Go to checkout
    	return redirect()
            ->route('shop.checkout')
            ->with('success', 'Produit en cours d\'achat. Veuillez effectuer le paiement.');
    }

    public function getCheckout(){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $order = Session::has('order') ? Session::get('order') : false;
        if (!$order) {
            return redirect()->route('shop.cart');
        }
        
        return view('shop.checkout')->with(['item' => $order]);
    }

    public function postCheckout(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $this->validate($request, [
            'action' => 'required',
        ]);
        
        $action = $request->action;
        if($action == 'update_session'){
            $order = Order::findOrFail($request->order);
            Session::put('order', $order);
            return redirect()
                ->route('shop.checkout')
                ->with('success', 'Votre commande a été reprise. Veuillez effectuer le paiement.');
        }
        
        $this->validate($request, [
            'stripe_token' => 'required',
        ]);
        
        $order = Session::has('order') ? Session::get('order') : false;
        if (!$order) {
            return redirect()->route('shop.cart');
        }

        $user = Auth::user();
        
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
                return redirect()->to('shop.checkout')
                    ->withErrors($e->getMessage())
                    ->withInput();
            }

            // Update user in the database with Stripe
            $user->stripe_id = $customer->id;
            $user->save();
        }
        
                
        $total    = $order->reservation;
        $currency = $order->currency;

        try{
            // Create the charge
            $result = \Stripe\Charge::create(array(
                "amount" => $total,
                "currency" => $currency,
                "customer" => $user->stripe_id,
                "description" => 'Purchase'
            ));
        }catch(\Exception $e){
            return redirect()->to('shop.checkout')
                ->withErrors($e->getMessage())
                ->withInput();
        }
        
        if ($result->status != 'succeeded') {
          return redirect()->to('shop.checkout')
              ->with('error', "Votre commande n'a pas été éffectuée. ".$result->message);
        }
    
        // Set as order and notify user
        $order->setAsOrdered();

        Session::put('order', $order);
        Session::save();
        
        return redirect()->route('shop.select.afa')
              ->with('success', "Votre commande a été éffectuée. Veuillez choisir l'AFA le plus proche du produit.");
    }


    
    /**
     * Select Afa for an ordered product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function afa(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $order = Session::has('order') ? Session::get('order') : false;
        if (!$order) {
            return redirect()->route('shop.cart');
        }
        
        $product = $order->product;
        
        $data = [];
        if(!$product || !$product->isDisponible()){
           return redirect()->route('product.index', $product)
           ->withInput()->with('error', "Ce produit n'est plus disponible.");
        }

        if(!$product->location){
           return redirect()->route('product.index', $product)
                ->with('error','Le systeme ne peut pas localiser le produit');
        }

        if(!$product->state_id){
           return redirect()->route('product.index', $product)
                ->with('error', "L'Etat sur lequel le produit se trouve est inconnu.");
        }
            
        $data[] = [
          'id' => $product->id,
          'lat' => $product->location->latitude:0,
          'lng' => $product->location->longitude:0,
          'title' => $product->title,
          'type' => 'product',
        ];
        
        $afas = User::ofRole('afa')
            ->isActive()
            ->where('state_id', $product->state_id)
            ->has('location')
            ->with('location')
            ->get();
        
        foreach($afas as $item){
            $data[] = [
              'id' => $item->id,
              'lat' => $item->location?$item->location->latitude:0,
              'lng' => $item->location?$item->location->longitude:0,
              'title' => $item->name,
              'content' => $item->meta('orga_description'),
              'type' => $item->role,
            ];
        }
        
        $action = route('shop.select.afa', $product);
    	return view('backend.afa.select')
            ->with('action', $action)
            ->with('location', Auth::user()->location)
            ->with('items', $afas)
            ->with('item', $product)
            ->with('distance', $distance)
            ->with('distances', $this->distances)
            ->with('data', json_encode($data));
    }
    
    /**
     * Select an apl
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function postAfa(Request $request, Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $order = Session::has('order') ? Session::get('order') : false;
        if (!$order) {
            return redirect()->route('shop.cart');
        }
        
        $afa = User::ofRole('afa')
            ->isActive()
            ->where('id', '=', $request->afa)
            ->first();
        
        if(!$afa){
    	   return redirect()
               ->route('shop.select.afa')
               ->withInput()
               ->with('error','Vous devez choisir un afa.');
        }
        
        $order->setAfa($afa);
        
        return redirect()
               ->route('member.orders')
               ->with('error', 'Votre achat est en cours. Vous pouvez contacter votre agence partenaire locale.');
        
    }
    
    /**
     * Show last order
     *
     * @return \Illuminate\Http\Response
     */
    public function lastOrder(){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $count = Order::where('author_id', \AUth::user()->id)
            ->where('status', 'pinged')
            ->count();
        
        $order = Session::has('order') ? Session::get('order') : null;
        return view('shop.order')->with(['item' => $order])
            ->with('count', $count);
    }
    
    /*
    * Cancelling order
    */
    public function cancelOrder(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $action = $request->input('action');
        switch($action){
            case 'item':
                $order = Order::findOrFail($request->order);
                $order->delete();
                
                $session = Session::has('order') ? Session::get('order') : null;
                if ($session && $session->id == $order->id ) {
                    Session::forget('order');
                }
                break;
            case 'session':
                $order = Session::has('order') ? Session::get('order') : null;
                if (!$order) {
                    return redirect()->route('profile')
                        ->with('error', 'Votre carte est encore vide.');
                }
                $order->delete();
                Session::forget('order');
                break;
            case 'all':
                Order::where('author_id', \Auth::user()->id)
                    ->where('status', 'pinged')
                    ->delete();
                break;
            default:
                abort(404);
                break;
        }
        
        return redirect()->route('shop.cart')->with('success', "Votre commande a bien été annulée.");
    }
}
