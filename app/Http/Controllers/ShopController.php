<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Notifications\AplChanged;

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
        if($category&&$category->id>0){
            $items = $category->products()
                ->ofStatus('published')
                ->where('quantity', '>', 0);;
        }else{
            $items = Product::ofStatus('published')
                ->where('quantity', '>', 0);
        }
        
        $search = new Search();
        $q = $request->q;
        if($q){
            $items = $items->where(function($query) use ($q){
                return $query->where('content', 'LIKE', '%'.$q.'%')
                    ->orWhere('title', 'LIKE', '%'.$q.'%');
            });
            $search->keyword = $q;
            if(!$request->ajax()) $search->save();
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
              'lat' => $product->location->latitude,
              'lng' => $product->location->longitude,
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
    	return view('member.apl.select')
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

        $apl = null;
        if($request->has('apl')){
            $apl = User::ofRole('apl')
                ->isActive()
                ->where('id', '=', $request->apl)
                ->first();
        }else{
    	   return redirect()
               ->route('shop.select.apl', $product)
               ->withInput()
               ->with('error','Vous devez choisir un apl avant de reserver un produit.');
        }
        
        if(!$apl){
    	   return redirect()
               ->route('shop.select.apl', $product)
               ->withInput()
               ->with('error','Vous devez choisir un apl avant de reserver un produit.');
        }
        
        if(!$request->input('confirm')){
            return back()->withInput()
               ->with('error','Vous devez accepter les termes et les conditions.');
        }
        
        // Update APL
        Auth::user()->apl_id = $apl->id;
        Auth::user()->apl_ends_at = \Carbon\Carbon::now()->addDays(option('payment.apl_ends_at', 180));
        Auth::user()->save();
        
        try{
            Auth::user()->notify(new AplChanged(Auth::user(), $apl));
        }catch(\Exception $e){}
        
        try{
            $apl->notify(new AplChanged($apl, Auth::user()));
        }catch(\Exception $e){}
        
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
        
        // Save order in database
        $order = Order::add($product, $apl);

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
            return redirect()->route('shop.cart')
                ->with('error', 'Votre panier est vide.');
        }
        
        if($order->status == 'ordered'){
            if($order->reserved_at && !$order->afa){
                return redirect()->route('shop.select.afa')
                    ->with('success', "Votre commande a été déjá éffectuée. Veuillez choisir l'AFA le plus proche du produit.");
            }
        }
        
        return view('member.checkout')->with(['item' => $order]);
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
        
        $order = Session::has('order') ? Session::get('order') : false;
        if(!$order){
            return redirect()->route('shop.cart')
                ->with('error', 'Votre panier est vide.');
        }
        
        $this->validate($request, [
            'stripe_token' => 'required',
        ]);

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
        if(!$product){
           return redirect()->route('shop.cart')
           ->withInput()->with('error', "Ce produit n'est plus disponible.");
        }

        if(!$product->location){
           return redirect()->route('product.index', $product)
                ->with('error','Le systeme ne peut pas localiser le produit');
        }

        /*
        if(!$product->state){
           return redirect()->route('product.index', $product)
                ->with('error', "L'Etat sur lequel le produit se trouve est inconnu.");
        }
        */
        
        $distance = $request->get('distance');
        if(empty($distance)) $distance = 100;
            
        $data[] = [
          'id' => $product->id,
          'lat' => $product->location->latitude,
          'lng' => $product->location->longitude,
          'title' => $product->title,
          'type' => 'product',
        ];
        
        $afas = User::ofRole('afa')
            ->isActive()
            //->where('state_id', $product->state_id)
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
        
        $display = $request->display?$request->display:(Session::has('display')?Session::get('display'):'map');
        if($display == 'list'){
            Session::put('display', 'list');
            $view = view('member.afa.select_list');
        }else{
            Session::put('display', 'map');
            $view = view('member.afa.select_map');
        }
        
        $action = route('shop.select.afa', $product);
    	return $view->with('action', $action)
            ->with('location', Auth::user()->location)
            ->with('items', $afas)
            ->with('item', $product)
            ->with('distance', $distance)
            ->with('distances', $this->distances)
            ->with('data', json_encode($data));
    }
    
    /**
     * Select an afa
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
        
        $this->validate($request, [
            'afa' => 'required|numeric',
        ]);
        
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
        
        Session::forget('order');
        
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
        
        $count = Order::where('author_id', \Auth::user()->id)
            ->where('status', 'pinged')
            ->count();
        
        $order = Session::has('order')?Session::get('order'):false;
        
        return view('member.order.last')->with(['item' => $order])
            ->with('title', __('member.order'))
            ->with('item', $order)
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
