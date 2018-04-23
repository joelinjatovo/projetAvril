<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Category;

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
        if(!$page){
            $page =1;
        }
        if($category){
            $items = Product::where("category_id","=", $category->id)
                ->paginate($this->pageSize);
        }else{
            $items = Product::paginate($this->pageSize);
        }
        
        $items = Product::paginate($this->pageSize);

        return view('shop.index', compact('items', 'page')); 
    }
    
    /**
     * Add product in cart
     *
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */
    public function add(Product $product){
        $this->middleware('auth');
        
    	$currentCart = Session::has('cart') ? Session::get('cart') : null;
    	$cart = Cart::getInstance($currentCart);
    	$cart->add($product);

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
        
        $currentCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = Cart::getInstance($currentCart);

        return view('shop.cart')->with(['item' => $cart]);
    }

    public function getCheckout(){
        $this->middleware('auth');
        
        if (Auth::guest() || !Session::get('cart')) {
            return redirect()->route('product.index')->with('error', 'Merci de vous connecté');
        }
        return view('shop.checkout');
    }

    public function postCheckout(){
        $this->middleware('auth');
        
        if (Auth::guest() || !Session::get('cart')) {
            return redirect()->route('product.index')->with('error', 'Merci de vous connecté');
        }

        $totalP = Session::get('cart')->totalP * 100;
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_nZJyPhr5zXad7xqqMNZ49i3J");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        // Charge the user's card:
        $charge = \Stripe\Charge::create(array(
          "amount" => $totalP,
          "currency" => "usd",
          "description" => "Paiement de test",
          "source" => $token,
        ));

        $cart = Session::get('cart');

        $order = new Order();
        $order->cart = serialize($cart);

        Auth::user()->orders()->save($order);

        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Votre commande a été éffectué');
    }

    public function reduceByOne(Product $product){
        $this->middleware('auth');

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
