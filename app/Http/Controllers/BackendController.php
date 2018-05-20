<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;

use App\Models\Cart;
use App\Models\Image;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        $view = view('backend.dashboard.'.$user->role)
            ->with('title', __('app.dashboard'))
            ->with('item', $user);
        
        $recent = [];
        $count  = [];
        
                
        $count['pins']  = 110;
        $recent['pins'] = $user->pins()
            ->orderBy('created_at', 'desc')
            ->take($this->recentSize)
            ->get();

        $count['favorites']  = 300;
        $recent['favorites'] = $user->favorites()
            ->orderBy('created_at', 'desc')
            ->take($this->recentSize)
            ->get();
        
        switch($user->role){
            case 'member':
                $currentCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = Cart::getInstance($currentCart);
                $view->with('cart', $cart);
                
                $count['orders']  = 20;
                $recent['orders'] = $user->purchases()
                    ->wherePivot('status', 'ordered')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['purchases']  = 30;
                $recent['purchases'] = $user->purchases()
                    ->wherePivot('status', 'paid')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                break;
            case 'apl':
                $count['customers']  = 10;
                $recent['customers'] = $user->customers()
                    ->isActive()
                    ->ofRole('member')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['orders']  = 20;
                $recent['orders'] = $user->sales()
                    ->wherePivot('status', 'ordered')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['sales']  = 30;
                $recent['sales'] = $user->sales()
                    ->wherePivot('status', 'paid')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                break;
            case 'afa':
                $count['orders']  = 5;
                $recent['orders'] = $user->sales()
                    ->wherePivot('status', 'ordered')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['sales']  = 20;
                $recent['sales'] = $user->sales()
                    ->wherePivot('status', 'paid')
                    ->orderBy('created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                break;
            case 'seller':
                $count['products']  = 50;
                $recent['products.'] = $user->products()
                    ->orderBy('products.created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['orders']  = 50;
                $recent['orders'] = $user->products()
                    ->wherePivot('products.status', 'ordered')
                    ->orderBy('products.created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                
                $count['sales']  = 200;
                $recent['sales'] = $user->products()
                    ->where('products.status', 'paid')
                    ->orderBy('products.created_at', 'desc')
                    ->take($this->recentSize)
                    ->get();
                break;
        } 
        
        $view->with('count', $count);
        $view->with('recent', $recent);
        return $view;
    }
    
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites()
    {
        $items = Auth::user()->favorites()
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.favorites'))
            ->with('items', $items);
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function pins()
    {
        $items = Auth::user()->pins()
            ->paginate($this->pageSize);
        
        return view('backend.product.all')
            ->with('title', __('app.pins'))
            ->with('items', Auth::user()->pins)
            ->with('items', $items);
    }

}
