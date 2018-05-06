<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Notifications\OrderPinged;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;

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
        $page = $request->get('page');
        if(!$page) $page =1;
        
        if($category==null||$category->id==0){
            $items = Product::paginate($this->pageSize);
        }else{
            $items = Product::where("category_id","=", $category->id)
                ->paginate($this->pageSize);
        }
        
        if($page2 = Page::where('path', '=', '/products*')->first()){
            $pubs = $page2->pubs;
        }else{
            $pubs = [];
        }
        
        $products = Product::orderBy('created_at','desc')->paginate(3);
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);

        return view('shop.index')
            ->with('items', $items)
            ->with('page', $page)
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('categories', $categories); 
    }
    
    /**
     * Add product in cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');
        Auth::check();
        
        if(!$product->isDisponible()){
    	   return back()->withInput()->with('error','Stock en rupture');
        }
        
        $apl = null;
        if($request->has('apl')){
            $apl = User::ofRole('apl')->isActive()->where('id', '=', $request->apl)->first();
        }
        
        // No APL selected
        if(!$apl && !Auth::user()->apl){
    	   return back()->withInput()->with('error','Vous devez chosir un apl.');
        }
        
        // Update APL
        if($apl && $apl->id>0 && $request->is_default){
            Auth::user()->apl_id = $apl->id;
            Auth::user()->save();
        }
        
        // Get Default APL if no APL chosen
        if(!$apl || $apl->id==0){
            $apl = Auth::user()->apl;
        }
        
        // Get AFA
        if($product->location){
            $afas = User::ofRole('afa')
                ->isActive()
                ->hasLocation()
                ->get();
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
    	   return back()->withInput()->with('error','Vous ne pouvez pas encore faire cet achat. Il n\'y a pas d\'agence dans la base');
        }
        
    	$currentCart = Session::has('cart') ? Session::get('cart') : null;
    	$cart = Cart::getInstance($currentCart);
        
        try{
            $cart->add($product, $apl, $afa);
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        

    	Session::put('cart', $cart);
    	Session::save();

    	return back()->with('success', 'Nouvel article ajouter au panier!');
    }

    /**
     * Show cart
     *
     * @return \Illuminate\Http\Response
     */
    public function cart(){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $currentCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = Cart::getInstance($currentCart);

        return view('shop.cart')->with(['item' => $cart]);
    }

    public function getCheckout(){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        if (!Session::has('cart')) {
            return redirect()->route('profile')
                ->with('error', 'Votre carte est encore vide.');
        }
        
        return view('shop.checkout');
    }

    public function postCheckout(Request $request){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $user = Auth::user();
        
        if (!Session::has('cart')) {
            return redirect()->route('profile')
                ->with('error', 'Votre carte est encore vide.');
        }
        
        $currentCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = Cart::getInstance($currentCart);
        
        if (count($cart->items)<=0) {
            return redirect()->route('profile')
                ->with('error', 'Votre carte est encore vide.');
        }

        $total = $cart->totalTma;
        $currency = $cart->currency;
        
        
        try{
            $result = \Braintree_Transaction::sale([
                'amount' => $total,
                'paymentMethodNonce' => $request->payment_method_nonce,
                'options' => [
                    'submitForSettlement' => true,
                ],
            ]);
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        
        if (!$result->success) {
          return back()->with('error', "Votre commande n'a pas été éffectué");
        }
    
        // Set as order and notify user
        $cart->setAsOrdered();

        Session::forget('cart');
        
        //Fire event
        
        return redirect()->route('profile')->with('success', 'Votre commande a été éffectué');
    }

    public function reduceByOne(Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');

        $currentCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = Cart::getInstance($currentCart);
        $cart->reduceByOne($id);

        Session::put('cart', $cart);
        Session::save();

        if ($cart->items <= 0) {
            Session::forget('cart');
        }

        return back()->with('success', "L'article a bien été supprimé !");
    }

    public function deleteAll(Product $product){
        $this->middleware('auth');
        $this->middleware('role:member');
        
        $currentCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = Cart::getInstance($currentCart);
        $cart->deleteAll($product);

        Session::put('cart', $cart);
        Session::save();

        if (count($cart->items) <= 0) {
            $cart->delete();
            Session::forget('cart');
        }

        return back()->with('success', "L'article a bien été supprimé !");
    }

}
