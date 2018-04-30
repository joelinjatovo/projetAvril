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
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $recentProducts = Product::orderBy('created_at','desc')->take(6)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        $blogs = Blog::orderBy('created_at', 'desc')->take(6)->get();
        return view('page.index')
            ->with('item', $page)
            ->with('pubs', $page->pubs)
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
        if($value = $request->old('content'))    $item->content = $value;
        if($value = $request->old('path'))       $item->path = $value;
        if($value = $request->old('page_order')) $item->page_order = $value;
        if($value = $request->old('parent_id'))  $item->parent_id = $value;
        if($value = $request->old('language'))   $item->language = $value;
        
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
                            'path' => 'required',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        // Create page
        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->parent_id = $request->parent_id;
        $page->page_order = $request->page_order;
        $page->path = $request->path;
        $page->language = $request->language;
        $page->save();
        
        return back()->with('success',"La page a été bien enregistrée.");
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
        
        if($value = $request->old('title'))      $item->title = $value;
        if($value = $request->old('content'))    $item->content = $value;
        if($value = $request->old('path'))       $item->path = $value;
        if($value = $request->old('page_order')) $item->page_order = $value;
        if($value = $request->old('parent_id'))  $item->parent_id = $value;
        if($value = $request->old('language'))   $item->language = $value;
        
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
                            'path' => 'required|max:100',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $page->title = $request->title;
        $page->content = $request->content;
        $page->parent_id = $request->parent_id;
        $page->page_order = $request->page_order;
        $page->path = $request->path;
        $page->language = $request->language;
        $page->save();
        
        return back()->with('success',"La page a été bien modifiée.");
    }
    
    /**
     * Show the list of page.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function allAdmin(Request $request, $filter='all')
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $page = $request->get('page');
        if(!$page) $page =1;
        
        $items = Page::paginate($this->pageSize);
        return view('admin.page.all', compact('items', 'filter', 'page')); 
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