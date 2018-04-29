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
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page = Page::where('path', '=', '/blogs*')->first()){
            $pubs = $page->pubs;
        }else{
            $pubs = [];
        }
        return view('blog.index')
                ->with('item', $blog)
                ->with('pubs', $pubs)
                ->with('products', $products)
                ->with('categories', $categories); 
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
        if($value = $request->old('title'))             $blog->title = $value;
        if($value = $request->old('content'))           $blog->content = $value;
        if($value = $request->old('meta_tag'))          $blog->meta_tag = $value;
        if($value = $request->old('meta_description'))  $blog->meta_description = $value;

        $categories = Category::all();
        $action = route('admin.blog.store');
        
        return view('admin.blog.update', ['item'=>$blog, 'action'=>$action, 'categories'=>$categories]);
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

        $blog = new Blog();
        if($value = $request->old('title'))             $blog->title = $value;
        if($value = $request->old('content'))           $blog->content = $value;
        if($value = $request->old('meta_tag'))          $blog->meta_tag = $value;
        if($value = $request->old('meta_description'))  $blog->meta_description = $value;

        $categories = Category::all();
        $action = route('admin.blog.update', ['blog'=>$blog]);
        
        return view('admin.blog.update', ['item'=>$blog, 'action'=>$action, 'categories'=>$categories]);
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
        
        $blog->slug = generateSlug($request->title);
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->meta_tag = $request->meta_tag;
        $blog->meta_description = $request->meta_description;
        $blog->post_type = $this->post_type;
        $blog->status = 'published';
        $blog->save();

        // Delete Old Category
        ObjectCategory::where('object_id','=',$blog->id)
            ->where('object_type','=', get_class($blog))
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
        if(!$page) $page =1;
        
        $items = Blog::ofStatus('published')
            ->where('post_type','=', $this->post_type)
            ->paginate($this->pageSize);
        
        if($request->ajax()){
            return response()->json(array(
                'html' => view('ajax.blog.all', compact('items'))->render()
            ));
        }
        
        
        $products = Product::orderBy('created_at','desc')->take(3)->get();
        $categories = Category::orderBy('created_at', 'desc')->take(5)->get();
        if($page2 = Page::where('path', '=', '/blogs*')->first()){
            $pubs = $page2->pubs;
        }else{
            $pubs = [];
        }

        return view('blog.all')
                ->with('items', $items)
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

        $page = $request->get('page');
        if(!$page){
            $page =1;
        }

        switch($filter){
            case 'starred':
                $items = Blog::where('starred','=', 1)
                    ->where('post_type','=', $this->post_type)
                    ->paginate($this->pageSize);
                break;
            case 'archived':
            case 'published':
            case 'trashed':
            case 'pinged':
                $items = Blog::ofStatus($filter)
                    ->where('post_type','=', $this->post_type)
                    ->paginate($this->pageSize);
                break;
            default:
            case 'all':
                $items = Blog::where('post_type','=', $this->post_type)
                        ->paginate($this->pageSize);
                break;
        }

        return view('admin.blog.all', compact('items', 'filter', 'page'));
    }


    /**
    * Mark as starred the Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function star(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $blog->starred = 1;
        $blog->save();
        return back()->with('success',"L'article a été ajouté aux favoris avec succés");
    }


    /**
    * Archive Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function archive(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $blog->status = "archived";
        $blog->save();
        return back()->with('success',"L'article a été achivé avec succés");
    }


    /**
    * Publish Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function publish(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $blog->status = "published";
        $blog->save();
        return back()->with('success',"L'article a été publié avec succés");
    }


    /**
    * Trash Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function trash(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $blog->status = "trashed";
        $blog->save();
        return back()->with('success',"L'article a été ajouté aux corbeilles avec succés");
    }


    /**
    * Restore Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function restore(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');

        $blog->status = "pinged";
        $blog->save();
        return back()->with('success',"L'article a été restoré avec succés");
    }


    /**
    * Delete Blog
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Blog  $blog
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request,Blog $blog)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $blog->delete();
        return redirect()->route('admin.dashboard')
            ->with('success',"L'article a été supprimé avec succés");
    }
}
