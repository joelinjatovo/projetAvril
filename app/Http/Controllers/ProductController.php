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
        if($product->status != 'published'){
            abort(404);
        }
        
        $product->view_count++;
        $product->save();
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page = Page::where('path', '=', '/products*')
            ->first();
        
        if($page){$pubs = $page->pubs;}else{$pubs = [];}
        
        $apls = User::ofRole('apl')->isActive()->get();
        
        $data = [
              'id' => $product->id,
              'lat' => $product->location?$product->location->latitude:0,
              'lng' => $product->location?$product->location->longitude:0,
              'title' => $product->title,
              'area' => $product->area,
              'type' => 'product',
            ];
        
        $product->load('images');
        
        return view('product.index')
            ->with('item', $product)
            ->with('location', $product->location)
            ->with('pubs', $pubs)
            ->with('products', $products)
            ->with('apls', $apls)
            ->with('data', json_encode($data))
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
            case 'ordered':
            case 'paid':
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
