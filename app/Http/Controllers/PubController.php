<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\BlogsController;
use Validator;
use Auth;

use App\Models\Pub;
use App\Models\Page;
use App\Models\PubPage;
use App\Models\Image;

class PubController extends Controller
{

    /**
     * Show a pub
     * Admin Only
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Pub $pub
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, Pub $pub)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        return view('admin.pub.index')
                ->with('item', $pub); 
    }
    
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
        if($value = $request->old('links'))      $item->links = $value;
        
        $action = route('admin.pub.store');
        $pages = Page::all();
        
        return view('admin.pub.update', [
            'item'=>$item, 
            'action'=>$action, 
            'pages'=>$pages
        ]);
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
        
        
        $pub = new Pub();
        
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $pub->image_id = $image->id;
        }
        
        $pub->title = $request->title;
        $pub->content = $request->content;
        $pub->links = $request->links;
        $pub->save();
        
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
        
        return back()->with('success',"La publicité a été bien enregistrée.");
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
        
        if($value = $request->old('title'))     $item->title = $value;
        if($value = $request->old('content'))   $item->content = $value;
        if($value = $request->old('links'))      $item->links = $value;
        
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
        
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $pub->image_id = $image->id;
        }
        
        $pub->title = $request->title;
        $pub->content = $request->content;
        $pub->links = $request->links;
        $pub->save();
        
        // remove Old Page
        PubPage::where('pub_id','=',$pub->id)
            ->delete();
        
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
        
        return back()->with('success',"La publicité a été bien modifiée.");
    }
    
    /**
     * Show the list of publicity.
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
        if(!$page){$page =1;}
        
        $items = Pub::paginate($this->pageSize);
        return view('admin.pub.all', compact('items', 'filter', 'page')); 
    }
    
    /**
    * Delete Pub
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Pub $pub
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request,Pub $pub)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $pub->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"La publicité a été supprimée avec succés");
    }
}
