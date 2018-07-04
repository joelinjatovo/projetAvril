<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Label;
use App\Models\Product;

class LabelController extends Controller
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
     * Store or update a product label
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @param  String  $type
     * @return Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request, Product $product, $type)
    {
        $this->middleware('auth');
        
        $label = $product->isStarred()
            ->where('author_id', \Auth::user()->id)
            ->first();
        
        if(!$label){
            $label = new Label();
            $label->label = $type;
            $label->product_id = $product->id;
            $label->save();
            $message = 'Produit ajoute au favoris';
        }else{
            $label->delete();
            $message = 'Produit supprime du favoris';
        }
        
        return redirect()->route('product.index', $product)
            ->with('success', $message);
    }
    
    /**
     * List a product label
     *
     * @param  Illuminate\Http\Request  $request
     * @param  String  $type
     * @return Illuminate\Http\Response
     */
    public function all(Request $request, $type)
    {
        $page = $request->get('page');
        if(!$page){ $page =1; }
        
        $items = Label::where('label', $type)
                        ->paginate($this->pageSize);
        
        return view('label.all', compact('items', 'filter', 'page')); 
    }
}
