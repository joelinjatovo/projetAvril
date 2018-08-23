<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }


    /**
     * Show a category
     * Admin Only
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Category $category
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, Category $category)
    {
        return view('admin.category.index')
                ->with('item', $category)
            ->with('breadcrumbs', __('app.category'));
    }
    
    /**
     * Create a category
     * Admin Only
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->allAdmin($request);
    }

    /**
     * Store a category
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
                            'title'   => 'required|max:100',
                            'content' => 'nullable',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $category = new Category();

        $slug = $slugOriginal = generateSlug($request->title);
        $i = 1;
        while(Category::where('slug', $slug)->exists()){
            $slug = $slugOriginal + '-' + $i++;
        }
        
        $category->slug = $slug;
        $category->title = $request->title;
        $category->content = $request->content;
        $category->save();

        return back()->with('success',"La categorie a été bien enregistrée.");
    }

    /**
     * Update category
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'title'   => 'required|max:100',
                            'content' => 'nullable',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $slug = $slugOriginal = generateSlug($request->title);
        $i = 1;
        while(Category::where('slug', $slug)->where('id', '<>', $category->id)->exists()){
            $slug = $slugOriginal + '-' + $i++;
        }
        
        $category->slug = $slug;
        $category->title = $request->title;
        $category->content = $request->content;
        $category->save();
        
        return back()->with('success',"Le category a été bien modifié.");
    }

    /**
     * Render form to edit a category
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Category  $category)
    {
        /* update item */
        if($value = $request->old('title'))     $category->title = $value;
        if($value = $request->old('content'))   $category->content = $value;
        $action = route('admin.category.update', ['category'=>$category]);
        
        return $this->_listAll($request)
            ->with('item', $category) 
            ->with('action', $action);
    }

    /**
     * Show the list of category.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function allAdmin(Request $request, $filter='all')
    {
        /* New item */
        $item = new Category();
        if($value = $request->old('title'))     $item->title = $value;
        if($value = $request->old('content'))   $item->content = $value;
        $action = route('admin.category.store');
        
        return $this->_listAll($request)
            ->with('item', $item) 
            ->with('action', $action);
    }


    /**
    * Delete Category
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Category $category
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request,Category $category)
    {
        if($category->id<5){
            return back()->with('error',"Cette action ne peut pas etre réalisée.");
        }
        $category->delete();
        return redirect()->route('admin.dashboard')
            ->with('success',"La categorie a été supprimée avec succés");
    }

    /**
     * return view to show list of category
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function _listAll(Request $request)
    {
        $title = __('app.admin.category.list');
        
        $items = new Category;
        
        $page = $request->get('page');
        if(!$page) $page = 1;
        
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
        
        return view('admin.category.all')
            ->with('items', $items) 
            ->with('page', $page) 
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('title', $title)
            ->with('breadcrumbs', $title);
    }

}
