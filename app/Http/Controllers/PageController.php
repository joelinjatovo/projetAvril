<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

use App\Models\Blog;
use App\Models\Page;
use App\Models\PubPage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;

class PageController extends Controller
{

    /**
     * Show a page
     * Front page
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Page $page
     * @return Illuminate\Http\Response
     */
    public function index(Request $request, Page $page)
    {
        $products = Product::orderBy('created_at','desc')
            ->take(3)->get();
        
        $recentProducts = Product::ofStatus('published')
            ->with('location')
            ->where('quantity', '>', 0)
            ->orderBy('created_at','desc')
            ->take(6)->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount(['products'])
            ->take(5)->get();
        
        $blogs = Blog::ofStatus('published')
            ->orderBy('created_at', 'desc')
            ->take(6)->get();
        
        $page->load(['childs']);
        
        return view('page.index')
            ->with('item', $page)
            ->with('products', $products)
            ->with('blogs', $blogs)
            ->with('recentProducts', $recentProducts)
            ->with('categories', $categories);
    }

    /**
     * Show a page
     * Admin Only
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Page $page
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, Page $page)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        return view('admin.page.index')
                ->with('item', $page); 
    }
    
    /**
     * Render form to create a page
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $item = new Page();
        if($value = $request->old('title'))      $item->title = $value;
        if($value = $request->old('title_en'))   $item->title_en = $value;
        if($value = $request->old('content'))    $item->content = $value;
        if($value = $request->old('content_en')) $item->content_en = $value;
        if($value = $request->old('page_order')) $item->page_order = $value;
        if($value = $request->old('parent_id'))  $item->parent_id = $value;
        if($value = $request->old('type'))       $item->type = $value;
        
        // type =  PUB
        if($value = $request->old('pub_url'))    $item->pub_url = $value;
        if($value = $request->old('pub_url_en')) $item->pub_url_en = $value;
        
        // type =  PAGE
        if($value = $request->old('path'))       $item->path = $value;
        
        $action = route('admin.page.store');
        $pages = Page::where('parent_id', 0)->get();
        return view('admin.page.update', ['item'=>$item, 'action'=>$action])
            ->with('pages', $pages);
    }
    
    /**
     * Store a page
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
            'type' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        // Create page
        $page = new Page();
        $page->title = $request->title;
        $page->title_en = $request->title_en;
        $page->content = $request->content;
        $page->content_en = $request->content_en;
        $page->parent_id = $request->parent_id?$request->parent_id:0;
        $page->page_order = $request->page_order?$request->page_order:0;
        $page->type = $request->type;
        
        if($page->type=='page'){
            $page->path = $request->path;
            $msg = "La page a été bien enregistrée.";
        }else{
            $page->pub_url = $request->pub_url;
            $page->pub_url_en = $request->pub_url_en;
            
            if($file=$request->file('pub_image')){
                $image = Image::storeAndSave($file);
                $$page->pub_image_id = $image->id;
            }
            
            if($file=$request->file('pub_image_en')){
                $image = Image::storeAndSave($file);
                $$page->pub_image_en_id = $image->id;
            }
            
            $msg = "La publicité a été bien enregistrée.";
        }
        
        $page->save();
        
        return back()->with('success', $msg);
    }
    
    /**
     * Render form to edit a page
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Page  $page
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Page $page)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($value = $request->old('title'))      $page->title = $value;
        if($value = $request->old('title_en'))   $page->title_en = $value;
        if($value = $request->old('content'))    $page->content = $value;
        if($value = $request->old('content_en')) $page->content_en = $value;
        if($value = $request->old('page_order')) $page->page_order = $value;
        if($value = $request->old('parent_id'))  $page->parent_id = $value;
        if($value = $request->old('type'))       $page->type = $value;
        
        // type =  PUB
        if($value = $request->old('pub_url'))    $item->pub_url = $value;
        if($value = $request->old('pub_url_en')) $item->pub_url_en = $value;
        
        // type =  PAGE
        if($value = $request->old('path'))       $item->path = $value;
        
        $action = route('admin.page.update', ['page'=>$page]);
        $pages = Page::where('parent_id', 0)->get();
        return view('admin.page.update', ['item'=>$page, 'action'=>$action])
            ->with('pages', $pages);
    }
    
    /**
     * Update product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        // Validate request
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:100',
            'content' => 'required',
            'type' => 'required|max:100',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $page->title = $request->title;
        $page->title_en = $request->title_en;
        $page->content = $request->content;
        $page->content_en = $request->content_en;
        $page->parent_id = $request->parent_id?$request->parent_id:0;
        $page->page_order = $request->page_order?$request->page_order:0;
        $page->type = $request->type;
        
        if($page->type=='page'){
            $page->path = $request->path;
            $msg = "La page a été bien modifiée.";
        }else{
            $page->pub_url = $request->pub_url;
            $page->pub_url_en = $request->pub_url_en;
            
            if($file=$request->file('pub_image')){
                $image = Image::storeAndSave($file);
                $page->pub_image_id = $image->id;
            }
            
            if($file=$request->file('pub_image_en')){
                $image = Image::storeAndSave($file);
                $page->pub_image_en_id = $image->id;
            }
            
            $msg = "La publicité a été bien modifiée.";
        }
        
        $page->save();
        
        return back()->with('success', $msg);
    }
    
    /**
     * Show the list of page.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $type
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function allAdmin(Request $request, $type, $filter='all')
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $title = __('app.admin.'.$type.'.list');
        
        $items = Page::where('type', $type);
        
        $page = $request->get('page');
        if(!$page){$page =1;}
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where(function($query) use($q){
                return $query->orWhere('title', 'LIKE', '%'.$q.'%')
                    ->orWhere('content', 'LIKE', '%'.$q.'%')
                    ->orWhere('title_en', 'LIKE', '%'.$q.'%')
                    ->orWhere('content_en', 'LIKE', '%'.$q.'%')
                    ->orWhere('path', 'LIKE', '%'.$q.'%');
            });
        }
        
        $items = $items->paginate($record);
        
        return view('admin.page.all', compact('items', 'filter', 'page'))
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('title', $title); 
    }
    
    /**
     * Order the list of page.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request, $filter='all')
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($request->ajax()){
            $parent_id = (int) $request->parent_id;
            $order = $request->order;
            $order = explode(',', $order);
            foreach($order as $key=>$value){
                $page = Page::findOrFail($value);
                $page->page_order = $key;
                $page->parent_id = $parent_id;
                $page->save();
            }
            return response()->json(array(
                'parent_id' => $parent_id,
                'order' => $order
            ));
        }
        
        $title = __('app.admin.page.order');
        
        $items = Page::where('parent_id', 0)->get();
        
        return view('admin.page.order', compact('items', 'filter'))
            ->with('title', $title); 
    }

    
    /**
    * Delete Page
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Page $page
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request,Page $page)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $page->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"La page a été supprimée avec succés");
    }

}