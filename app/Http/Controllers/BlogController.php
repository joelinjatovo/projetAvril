<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Blog;
use App\Models\Category;
use App\Models\ObjectCategory;
use App\Models\Image;
use App\Models\Product;
use App\Models\Page;

class BlogController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Type of Blog in database
     *
     */
    protected $post_type = 'blog';

    /**
     * Show a blog
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Blog  $blog
     * @return Illuminate\Http\Response
     */
    public function index(Request $request, Blog $blog)
    {
        if($blog->status != 'published'){
            abort(404);
        }
        
        $blog->view_count++;
        $blog->save();
        
        $products = Product::orderBy('created_at','desc')
            ->ofStatus('published')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount('products')
            ->take($this->recentSize)
            ->get();
        
        $page = Page::where('path', '=', '/blogs*')
            ->first();
        
        if($page){$pubs = $page->pubs;}else{$pubs = [];}
        
        return view('blog.index')
                ->with('item', $blog)
                ->with('pubs', $pubs)
                ->with('products', $products)
                ->with('categories', $categories); 
    }

    /**
     * Show the list of blog.
     * Public Acces
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, $filter='all')
    {
        $page = $request->get('page');
        if(!$page) $page = 1;
        
        $orderBy = $request->get('orderBy');
        if(!in_array($orderBy, ['created_at', 'view_count'])) $orderBy = 'created_at';
        
        $order = $request->get('order');
        if(!in_array($order, ['desc', 'asc'])) $order = 'desc';
        
        $items = Blog::ofStatus('published')
            ->where('post_type','=', $this->post_type)
            ->orderBy($orderBy, $order)
            ->withCount('comments')
            ->paginate($this->pageSize);
        
        if($request->ajax()){
            return response()->json(array(
                'html' => view('ajax.blog.all', compact('items'))->render()
            ));
        }
        
        $products = Product::ofStatus('published')
            ->with('location')
            ->where('quantity', '>', 0)
            ->orderBy('created_at','desc')
            ->take($this->recentSize)
            ->get();
        
        $categories = Category::orderBy('created_at', 'desc')
            ->has('products')
            ->withCount(['products'])
            ->take($this->recentSize)
            ->get();
        
        $page2 = Page::where('path', '=', '/blogs*')
            ->first();
        
        if($page2){$pubs = $page->pubs;}else{$pubs = [];}

        return view('blog.all')
                ->with('items', $items)
                ->with('orderBy', $orderBy)
                ->with('order', $order)
                ->with('filter', $filter)
                ->with('page', $page)
                ->with('pubs', $pubs)
                ->with('products', $products)
                ->with('categories', $categories); 
    }

    /**
     * Show the list of blog.
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
        
        $items = Blog::where('post_type','=', $this->post_type)
            ->withCount('comments');
        
        $title = __('app.admin.blog.list');
        switch($filter){
            case 'starred':
                $items = $items->where('starred', 1);
                $title = __('app.blog.list.starred');
                break;
            case 'archived':
            case 'published':
            case 'trashed':
            case 'pinged':
                $items = $items->ofStatus($filter);
                $title = __('app.blog.list.status', ['status'=>__('app.'.$filter)]);
                break;
        }
        
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
        
        return view('admin.blog.all')
            ->with('q', $q) 
            ->with('record', $record) 
            ->with('title', $title)
            ->with('items', $items)
            ->with('breadcrumbs', $title);
    }

    /**
     * Render form to create a blog
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $blog = new Blog();
        $categoryIds = [];
        if($value = $request->old('title'))             $blog->title = $value;
        if($value = $request->old('content'))           $blog->content = $value;
        if($value = $request->old('meta_tag'))          $blog->meta_tag = $value;
        if($value = $request->old('meta_description'))  $blog->meta_description = $value;
        if($value = $request->old('category'))          $categoryIds = $value;

        $categories = Category::where('type', 'blog')->get();
        $action = route('admin.blog.store');
        
        return view('admin.blog.update')
            ->with('title', __('app.blog.create'))
            ->with('item', $blog)
            ->with('action', $action)
            ->with('categoryIds', $categoryIds)
            ->with('categories', $categories)
            ->with('breadcrumbs', __('app.blog.create'));
    }

    /**
     * Store a blog
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
                            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $blog = new Blog();
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $blog->image_id = $image->id;
        }
        
        $slug = $slugOriginal = generateSlug($request->title);
        $i = 1;
        while(Blog::where('slug', $slug)->exists()){
            $slug = $slugOriginal + '-' + $i++;
        }
        
        $blog->slug = $slug;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->meta_tag = $request->meta_tag;
        $blog->meta_description = $request->meta_description;
        $blog->post_type = $this->post_type;
        $blog->status = 'published';
        $blog->save();

        // Add Blog to the selected category
        if($categories = $request->category){
            foreach($categories as $categoryId){
                $row = new ObjectCategory();
                $row->category_id = $categoryId;
                $row->object_id = $blog->id;
                $row->object_type = get_class($blog);
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }
        
        return back()->with('success',"L'article a été bien enregistré.");
    }

    /**
     * Render form to edit a blog
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Blog  $blog
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $categoryIds = [];
        foreach($blog->categories as $category){
            $categoryIds[] = $category->id;
        }
        
        if($value = $request->old('title'))             $blog->title = $value;
        if($value = $request->old('content'))           $blog->content = $value;
        if($value = $request->old('meta_tag'))          $blog->meta_tag = $value;
        if($value = $request->old('meta_description'))  $blog->meta_description = $value;
        if($value = $request->old('category'))          $categoryIds = $value;

        $categories = Category::where('type', 'blog')->get();
        $action = route('admin.blog.update', ['blog'=>$blog]);
        
        return view('admin.blog.update')
            ->with('title', __('app.blog.update'))
            ->with('item', $blog)
            ->with('action', $action)
            ->with('categoryIds', $categoryIds)
            ->with('categories', $categories)
            ->with('breadcrumbs', __('app.blog.update'));
    }

    /**
     * Update User
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        // Validate request
        $validator = Validator::make($request->all(),[
                            'title' => 'required|max:100',
                            'content' => 'required',
                            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        
        if($file=$request->file('image')){
            $image = Image::storeAndSave($file);
            $blog->image_id = $image->id;
        }
        
        $slug = $slugOriginal = generateSlug($request->title);
        $i = 1;
        while(Blog::where('slug', $slug)->where('id', '<>', $blog->id)->exists()){
            $slug = $slugOriginal + '-' + $i++;
        }
        
        $blog->slug = $slug;
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->meta_tag = $request->meta_tag;
        $blog->meta_description = $request->meta_description;
        $blog->post_type = $this->post_type;
        $blog->status = 'published';
        $blog->save();

        // Delete Old Category
        ObjectCategory::where('object_id','=', $blog->id)
            ->where('object_type', '=', get_class($blog))
            ->delete();

        // Add Blog to the selected category
        if($categories = $request->category){
            foreach($categories as $categoryId){
                $row = new ObjectCategory();
                $row->category_id = $categoryId;
                $row->object_id = $blog->id;
                $row->object_type = get_class($blog);
                $row->author_id = Auth::user()->id;
                $row->save();
            }
        }

        return back()->with('success',"L'article a été bien modifié.");
    }

    /**
    * Delete Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function action(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        // Validate request
        $this->validate($request, [
            'action' => 'required|max:10',
            'data_id'   => 'required|numeric'
        ]);
        
        $blog = Blog::findOrFail($request->data_id);
        
        $action = $request->action;
        switch($action){
            case 'archive':
                $blog->status = 'archived';
                $blog->save();
                $message = "L'article a été achivé avec succés";
            break;
            case 'publish':
                $blog->status = 'published';
                $blog->save();
                $message = "L'article a été publié avec succés";
            break;
            case 'unstar':
                $blog->starred = 0;
                $blog->save();
                $message = "L'article a été supprimé parmi les articles favoris avec succés";
            break;
            case 'star':
                $blog->starred = 1;
                $blog->save();
                $message = "L'article a été ajouté aux favoris avec succés";
            break;
            case 'delete':
                $blog->delete();
                $message = "L'article a été supprimé avec succés";
            break;
            default:
                abort(404);
            break;
        }
        
        if($request->ajax()){
            return response()->json([
                'status'=>1,
                'message'=>$message
            ]);
        }
        
        return redirect()->route('admin.dashboard')
            ->with('success', $message);
    }
}
