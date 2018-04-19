<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Models\PubPage;

class PageController extends Controller
{
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
        if($value = $request->old('title'))     $item->title = $value;
        if($value = $request->old('path'))      $item->content = $value;
        
        $action = route('admin.page.store');
        return view('page.admin.update', ['item'=>$item, 'action'=>$action]);
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
                            'path' => 'required',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        // Create page
        $pub = Page::create($datas);
        
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
        
        if($value = $request->old('title'))     $pub->title = $value;
        if($value = $request->old('path'))      $pub->content = $value;
        
        $action = route('admin.page.update', ['page'=>$page]);
        return view('page.admin.update', ['item'=>$pub, 'action'=>$action]);
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
                            'path' => 'required|max:100',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $page->title = $request->input('title');
        $page->path = $request->input('path');
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
    public function all(Request $request, $filter='all')
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $page = $request->get('page');
        if(!$page){
            $page =1;
        }
        
        $items = Page::paginate($this->pageSize);
        return view('pub.admin.all', compact('items', 'filter', 'page')); 
    }
}
