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
        //$this->middleware('auth');
    }

    /**
     * Render form to create a category
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

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
                            'title' => 'required|max:100',
                            'content' => 'required',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $datas['slug'] = generateSlug($request->title);

        Category::create($datas);
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
        $this->middleware('auth');
        $this->middleware('role:admin');

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

        $category->title = $request->input('title');
        $category->content = $request->input('content');
        $category->slug = generateSlug($category->title);
        $category->save();
        return back()->with('success',"Le produit a été bien modifié.");
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
        $this->middleware('auth');
        $this->middleware('role:admin');

        $page = $request->get('page');
        if(!$page) $page =1;

        $items = Category::paginate($this->pageSize);
        return view('admin.category.all', compact('items', 'filter', 'page'));
    }
}
