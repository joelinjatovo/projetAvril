<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\Product;
use App\Models\Search;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Perform global search.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category = null)
    {
        //dd($request->request);
        //exit;
        
        $items = Product::ofStatus('published');
        
        if($request->state){
            $items = $items->where('state_id', $request->state);
        }
        
        if($request->type){
            $items = $items->where('type_id', $request->type);
        }
        
        if($request->location_type){
            $items = $items->where('location_type_id', $request->location_type);
        }
        
        if($request->price){
            $prices = preg_split("/,/", $request->price);
            $items = $items->whereBetween('price', $prices);
        }
        
        if($request->area){
            $areas = preg_split("/,/", $request->area);
            $items = $items->whereBetween('area', $areas);
        }

        $items = $items->paginate(20);
        
        $search = new Search();
        $search->content = serialize($request->all());
        $search->save();
        
    	return view('search.index')
            ->with('items', $items);
    }

}
