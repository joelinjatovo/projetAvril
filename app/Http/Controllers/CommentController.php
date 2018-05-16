<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use Illuminate\Http\Request;

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
                            'title'   => 'required|max:100',
                            'content' => 'required',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $datas['blog_id'] = $blog->id;
        $comment = Comment::create($datas);
        
        $view = view('comment.index')->render();
        
        return response()->json(array(
            'html'=>$view, 
            'msg'=>'Le commentaire a été bien  enregistré'
        ));
    }
    
    /**
     * Render form to edit a blog
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\Blog  $blog
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, Blog $blog, Comment $comment)
    {
        if($value = $request->old('content'))   $comment->content = $value;
        
        $action = route('comment.update', ['blog'=>$blog,'comment'=>$comment]);
        
        $view = view('comment.update', ['item'=>$blog, 'action'=>$action, 'comment'=>$comment])->render();
        
        return response()->json(array('html'=>$view));
    }
    
    /**
     * Update User
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog, Comment $comment)
    {
        // Validate request
        $validator = Validator::make($request->all(),[
                            'title' => 'required|max:100',
                            'content' => 'required',
                        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $comment->title = $request->input('title');
        $comment->content = $request->input('content');
        $comment->save();
        
        $view = view('comment.index')->render();
        return response()->json(array('html'=>$view, 'msg'=>'Le commentaire a été bien modifié'));
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
