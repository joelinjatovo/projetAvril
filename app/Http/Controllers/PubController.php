<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\BlogsController;

use App\Models\Pub;
use App\Models\Page;
use App\Models\PubPage;

class PubController extends Controller
{
    /**
     * Render form to create a publicity
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $item = new Pub();
        if($value = $request->old('title'))     $item->title = $value;
        if($value = $request->old('content'))   $item->content = $value;
        if($value = $request->old('link'))      $item->lik = $value;
        
        $action = route('admin.pub.store');
        $pages = Page::all();
        return view('admin.pub.update', ['item'=>$item, 'action'=>$action, 'pages'=>$pages]);
    }
    
    /**
     * Store a publicity
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
                            'links' => 'url',
                            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        
        if($file=$request->file('image')){
            $image = $file->store('uploads');
            $datas['image'] = $image;
        }else{
            $datas['image'] = null;
        }
        
        // Create Publicity
        $pub = Pub::create($datas);
        
        // Add Publicity to the selected page
        if($pages = $request->page){
            foreach($pages as $pageId){
                $row = new PubPage();
                $row->page_id = $pageId;
                $row->pub_id = $pub->id;
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }
        
        return back()->with('success',"La publicite a été bien enregistrée.");
    }
    
    /**
     * Render form to edit a product
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Pub $pub)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        if($value = $request->old('title'))     $pub->title = $value;
        if($value = $request->old('path'))      $pub->content = $value;
        
        $action = route('admin.pub.update', ['pub'=>$pub]);
        $pages = Page::all();
        return view('admin.pub.update', ['item'=>$pub, 'action'=>$action, 'pages'=>$pages]);
    }
    
    /**
     * Update publicity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pub  $pub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pub $pub)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        // Validate request
        $validator = Validator::make($request->all(),[
                            'title' => 'required|max:100',
                            'content' => 'required',
                            'links' => 'url',
                            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $pub->title = $request->input('title');
        $pub->content = $request->input('content');
        $pub->links = $request->input('link');
        if($file=$request->file('image')){
            $image = $file->store('uploads');
            $pub->image = $image;
        }
        $pub->save();
        
        // TODO remove Old Page
        
        // Add Publicity to the selected page
        if($pages = $request->page){
            foreach($pages as $pageId){
                $row = new PubPage();
                $row->page_id = $pageId;
                $row->pub_id = $pub->id;
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }
        
        return back()->with('success',"La publicte a été bien modifiée.");
    }
    
    /**
     * Show the list of publicity.
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
        
        $items = Pub::paginate($this->pageSize);
        return view('admin.pub.all', compact('items', 'filter', 'page')); 
    }
}
