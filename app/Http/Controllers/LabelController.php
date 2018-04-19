<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductLabel;

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
     * @param  App\Models\RowProduct  $product
     * @param  String  $type
     * @return Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request, RowProduct $product, $type)
    {
        $label = ProductLabel::where('row_product_id','=', $product->id)
            ->where('label','=', $type)
            ->first();
        if($label){
            $label =new ProductLabel();
        }
        $label->label = $type;
        $label->product_id = $product->id;
        $label->save();
        
        return response()->json(array('msg'=>'Product $type'),200);
    }
    
    /**
     * List a product label
     *
     * @param  Illuminate\Http\Request  $request
     * @param  String  $type
     * @return Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request, $type)
    {
        $page = $request->get('page');
        if(!$page){ $page =1; }
        $items = ProductLabel::where('label','=', $type)
                        ->paginate($this->pageSize);
        return view('label.all', compact('items', 'filter', 'page')); 
    }
}
