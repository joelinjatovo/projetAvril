<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Blog;

class BlogController extends Controller
{
    
    /**
     * Type of Blog in database
     *
     */
    protected $post_type = 'post';
    
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
        if($title = $request->old('title')){
            $blog->title = $title;
        }
        if($content = $request->old('content')){
            $blog->content = $content;
        }
        $action = route('admin.blog.store');
        return view('blog.admin.update', ['item'=>$blog, 'action'=>$action]);
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
        
        if($file=$request->file('image')){
            $image = $file->store('uploads');
            $datas["image"] = $image;
        }
        $datas["author_id"] = Auth::user()->id;
        $datas["post_type"] = $this->post_type;
        Blog::create($datas);
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
        
        if($title = $request->old('title')){
            $blog->title = $title;
        }
        if($content = $request->old('content')){
            $blog->content = $content;
        }
        
        $action = route('admin.blog.update', ['blog'=>$blog]);
        return view('blog.admin.update', ['item'=>$blog, 'action'=>$action]);
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
        
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        if($file=$request->file('image')){
            $image = $file->store('uploads');
            $blog->image = $image;
        }
        $blog->save();
        
        return back()->with('success',"L'utilisateur a été bien modifié.");
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
        if(!$page){
            $page =1;
        }
        
        switch($filter){
            case 'starred':
                $items = Blog::where('starred','=', 1)
                    ->where('post_type','=', $this->post_type)
                    ->paginate($this->pageSize);
                break;
            case 'archive':
                $items = Blog::where('status','=', 'archived')
                    ->where('post_type','=', $this->post_type)
                    ->paginate($this->pageSize);
                break;
            default:
            case 'all':
                $items = Blog::where('post_type','=', $this->post_type)
                        ->paginate($this->pageSize);
                break;
        }
        
        return view('blog.all', compact('items', 'filter', 'page')); 
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
            case 'archive':
                $items = Blog::where('status','=', 'archived')
                    ->where('post_type','=', $this->post_type)
                    ->paginate($this->pageSize);
                break;
            default:
            case 'all':
                $items = Blog::where('post_type','=', $this->post_type)
                        ->paginate($this->pageSize);
                break;
        }
        
        return view('blog.admin.all', compact('items', 'filter', 'page')); 
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
        return redirect()->route('admin.dashboard')
            ->with('success',"L'article a été supprimé avec succés");
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
        return redirect()->route('admin.dashboard')
            ->with('success',"L'article a été supprimé avec succés");
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
        
        $blog->status = "published";
        $blog->save();
        return redirect()->route('admin.dashboard')
            ->with('success',"L'article a été supprimé avec succés");
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
