<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RowProduct;
use App\Models\Product;

class RowProductController extends Controller
{
    /**
     * Show the row product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RowProduct  $rowproduct
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RowProduct $rowproduct)
    {
        return view('rowproduct.index', ['item'=>$rowproduct]); 
    }
    
    /**
     * Show the list of row product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $category
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, Product $product = null)
    {
        $page = $request->get('page');
        if(!$page){
            $page =1;
        }
        if($product){
            $items = RowProduct::where("product_id","=",$product->id)
                ->paginate($this->pageSize);
        }else{
            $items = RowProduct::paginate($this->pageSize);
        }
        return view('rowproduct.all', compact('items', 'filter', 'page')); 
    }
}
