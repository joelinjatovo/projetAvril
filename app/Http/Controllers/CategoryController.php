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
                ->with('item', $category); 
    }

    /**
     * Render form to create a category
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $item = new Category();
        if($value = $request->old('title'))     $item->title = $value;
        if($value = $request->old('content'))   $item->content = $value;

        $action = route('admin.category.store');
        return view('admin.category.update', ['item'=>$item, 'action'=>$action]);
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
     * Render form to edit a category
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Category  $category)
    {
        if($value = $request->old('title'))     $item->title = $value;
        if($value = $request->old('content'))   $item->content = $value;

        $action = route('admin.category.update', ['category'=>$category]);
        
        return view('admin.category.update', ['item'=>$category, 'action'=>$action]);
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
     * Show the list of category.
     * Admin Only
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function allAdmin(Request $request, $filter='all')
    {
        $page = $request->get('page');
        if(!$page) $page = 1;

        $items = Category::paginate($this->pageSize);
        
        return view('admin.category.all', compact('items', 'filter', 'page'));
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
}
