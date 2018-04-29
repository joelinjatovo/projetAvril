<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Product;
use App\Models\Category;
use App\Models\ObjectCategory;
use App\Models\Image;
use App\Models\Page;
use App\Models\Pub;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Show the row product at the front.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page = Page::where('path', '=', '/products*')->first()){
            $pubs = $page->pubs;
        }else{
            $pubs = [];
        }
        $apls = User::ofRole('apl')->isActive()->get();
        return view('product.index')
            ->with('item', $product)
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('apls', $apls)
            ->with('categories', $categories); 
    }
    
    /**
     * Show the row product at the back.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        return view('admin.product.index')
            ->with('item', $product); 
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
        if($value = $request->old('title'))     $item->title = $value; 
        if($value = $request->old('content'))   $item->content = $value; 
        if($value = $request->old('price'))     $item->content = $value; 
        if($value = $request->old('tma'))       $item->content = $value; 
        
        $action = route('admin.product.store');
        $categories = Category::all();
        return view('admin.product.update', ['item'=>$item, 'action'=>$action, 'categories'=>$categories]);
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
                            'price' => 'required',
                            'tma' => 'required',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $product = new Product();
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $item->image_id = $image->id;
        }
        
        $product->status = 'published';
        $product->title = $request->title;
        $product->content = $request->content;
        $product->price = $request->price;
        $product->tma = $request->tma;
        
        // Create Product
        $item->save();

        // Add Blog to the selected category
        if($categories = $request->category){
            foreach($categories as $categoryId){
                $row = new ObjectCategory();
                $row->category_id = $categoryId;
                $row->object_id = $product->id;
                $row->object_type = get_class($product);
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }
        
        return back()->with('success',"Le produit a été bien enregistré.");
    }
    
    /**
     * Render form to edit a product category
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($value = $request->old('title'))     $item->title = $value; 
        if($value = $request->old('content'))   $item->content = $value; 
        if($value = $request->old('price'))     $item->content = $price; 
        if($value = $request->old('tma'))       $item->content = $tma; 
        
        $action = route('admin.product.update', ['product'=>$product]);
        $categories = Category::all();
        
        return view('admin.product.update', ['item'=>$product, 'action'=>$action, 'categories'=>$categories]);
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
        
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $product->image_id = $image->id;
        }
        
        $product->title = $request->title;
        $product->content = $request->content;
        $product->price = $request->price;
        $product->tma = $request->tma;
        $product->save();

        // TODO Remove Old Category

        // Add Blog to the selected category
        if($categories = $request->category){
            foreach($categories as $categoryId){
                $row = new ObjectCategory();
                $row->category_id = $categoryId;
                $row->object_id = $product->id;
                $row->object_type = get_class($product);
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }
        
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
        if(!$page) $page = 1;
        
        switch($filter){
            case 'published':
            case 'pinged':
            case 'archived':
            case 'trashed':
                $items = Product::ofStatus($filter)
                    ->paginate($this->pageSize);
                break;
            default:
            case 'all':
                $items = Product::paginate($this->pageSize);
                break;
        }
        
        return view('admin.product.all', compact('items', 'filter', 'page')); 
    }
    /**
    * Publish product
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function publish(Request $request,Product  $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $product->status = 'published';
        $product->save();
        return back()->with('success',"Le produit a été publié avec succés");
    }
    
    /**
    * Save product in archive
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function archive(Request $request,Product  $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $product->status = 'archived';
        $product->save();
        return back()->with('success',"Le produit a été archivé avec succés");
    }
    
    /**
    * Restore trashed product
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function restore(Request $request,Product  $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $user->status = 'pinged';
        $user->save();
        return back()->with('success',"Le produit a été restoré avec succés");
    }
    
    /**
    * Trash product
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function trash(Request $request,Product  $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $user->status = 'trashed';
        $user->save();
        return back()->with('success',"Le produit a été ajouté au corbeille avec succés");
    }
    
    /**
    * Delete Produt
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request,Product  $product)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $product->delete();
        return redirect()->route('admin.dashboard')
            ->with('success',"Le produit a été supprimé avec succés");
    }

}
