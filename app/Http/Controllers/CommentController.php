<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    /**
     * Store a comment
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request, Blog $blog)
    {
        // Validate request
        $datas = $request->all();
        $validator = Validator::make($datas,[
                'content' => 'required',
            ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->blog_id = $blog->id;
        $comment->save();
        
        if($request->ajax()){
            $view = view('comment.index')->with('item', $comment)->render();
            return response()->json(array(
                'html'=>$view, 
                'msg'=>'Le commentaire a été bien  enregistré'
            ));
        }
        
        return back()->with('success', 'Le commentaire a été bien  enregistré');
    }
    
    /**
     * Show the list of blog.
     * Public Acces
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $filter
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, Blog $blog, $filter='all')
    {
        $page = $request->get('page');
        if(!$page){ $page =1; }
        $items = Comment::where('blog_id','=', $blog->id)
                        ->paginate($this->pageSize);
        return view('comment.all', compact('items', 'filter', 'page')); 
    }
}
