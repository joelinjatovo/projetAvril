<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\ObjectCategory;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Render form to create a product
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $item = new Product();
        if($title = $request->old('title')){
            $item->title = $title;
        }
        if($content = $request->old('content')){
            $item->content = $content;
        }
        $action = route('admin.product.store');
        return view('product.admin.update', ['item'=>$item, 'action'=>$action]);
    }
    
    /**
     * Store a product
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
                            'title' => 'required|max:100',
                            'content' => 'required',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        
        // Create Product
        $product = Product::create($datas);
        
        return back()->with('success',"Le produit a été bien enregistré.");
    }
    
    /**
     * Render form to edit a product
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Product  $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($title = $request->old('title')){
            $product->title = $title;
        }
        if($content = $request->old('content')){
            $product->content = $content;
        }
        $action = route('admin.product.update', ['product'=>$product]);
        return view('product.admin.update', ['item'=>$product, 'action'=>$action, 'categories'=>$categories]);
    }
    
    /**
     * Update product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        // Validate request
        $validator = Validator::make($request->all(),[
                            'title' => 'required|max:100',
                            'content' => 'required',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $product->title = $request->input('title');
        $product->content = $request->input('content');
        $product->save();
        
        return back()->with('success',"Le produit a été bien modifié.");
    }
    
    /**
     * Show the list of product.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, $filter='all')
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $page = $request->get('page');
        if(!$page){
            $page =1;
        }
        
        $items = Product::paginate($this->pageSize);
        return view('product.admin.all', compact('items', 'filter', 'page')); 
    }

}
