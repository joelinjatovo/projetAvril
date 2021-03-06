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
        $pageIds = [];
        if($value = $request->old('title'))     $item->title = $value;
        if($value = $request->old('content'))   $item->content = $value;
        if($value = $request->old('links'))     $item->links = $value;
        if($value = $request->old('page'))      $pageIds = $value;
        
        $action = route('admin.pub.store');
        $pages = Page::all();
        
        return view('admin.pub.update', [
            'item'=>$item, 
            'action'=>$action, 
            'pages'=>$pages,
            'pageIds'=>$pageIds
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

        $pageIds = [];
        foreach($pub->pages as $page){
            $pageIds[] = $page->id;
        }
        
        
        if($value = $request->old('title'))     $item->title = $value;
        if($value = $request->old('content'))   $item->content = $value;
        if($value = $request->old('links'))     $item->links = $value;
        if($value = $request->old('page'))      $pageIds = $value;
        
        $action = route('admin.pub.update', ['pub'=>$pub]);
        
        $pages = Page::all();
        
        return view('admin.pub.update', ['item'=>$pub, 'action'=>$action, 'pages'=>$pages])
            ->with('pageIds', $pageIds);
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
        
        $title = __('app.admin.pub.list');
        
        $items = new Pub;
        
        $page = $request->get('page');
        if(!$page){$page =1;}
        
        $record = $request->get('record');
        if(!$record) $record = $this->pageSize;
        
        $q = $request->get('q');
        $q = trim($q);
        if($q){
            $items = $items->where(function($query) use($q){
                return $query->orWhere('title', 'LIKE', '%'.$q.'%')
                    ->orWhere('content', 'LIKE', '%'.$q.'%');
            });
        }
        
        $items = $items->paginate($record);
        return view('admin.pub.all', compact('items', 'filter', 'page'))
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('title', $title); 
    }
    
    /**
    * Detach Pub from Page
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Pub $pub
    * @param  \App\Models\Page $page
    * @return \Illuminate\Http\Response
    */
    public function detach(Request $request,Pub $pub, Page $page)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        PubPage::where('pub_id', $pub->id)
            ->where('page_id', $page->id)
            ->delete();
        
        return redirect()->back()->with('success',"La publicité a été supprimée avec succés");
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
