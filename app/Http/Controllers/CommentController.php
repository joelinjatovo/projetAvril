<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\CommentSpam;
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
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        /*
        $this->validate($request, [
            'content' => 'required',
            'reply_id' => 'filled',
            'blog_id' => 'filled',
            'user_id' => 'required',
        ]);
        */
        $comment = Comment::create($request->all());
 
        return [ "status" => "true", "commentId" => $comment->id ];
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  $commentId
    * @param  $type
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Comment $comment, $type)
    {
       if($type == "vote"){          
           $this->validate($request, [
                'vote' => 'required',
                'user_id' => 'required',
           ]);
 
           $data = [
               "comment_id" => $comment->id,
               'vote' => $request->vote,
               'user_id' => $request->user_id,
           ];
 
           if($request->vote == "up"){
               $vote = $comment->votes;
               $vote++;
               $comment->votes = $vote;
               $comment->save();
           }
 
           if($request->vote == "down"){
               $vote = $comment->votes;
               $vote--;
               $comment->votes = $vote;
               $comment->save();
           }
 
           if(CommentVote::create($data))
               return "true";
 
       }
 
       if($type == "spam"){
           $this->validate($request, [
               'user_id' => 'required',
           ]);
 
           $spam = $comment->spam;
           $spam++;
           $comment->spam = $spam;
           $comment->save();
           $data = [
               "comment_id" => $comment->id,
               'user_id' => $request->user_id,
           ];
 
           if(CommentSpam::create($data))
               return "true";
 
       }
 
    }
    
    /**
    * Get Comments for pageId
    *
    * @return Comments
    */
    public function index(Blog $blog)
    {
       $comments = Comment::where('blog_id', $blog->id)->get();
       $commentsData = [];
       foreach ($comments as $key) {
           $user = User::find($key->user_id);
           $name = $user->name;
           $replies = $this->replies($key->id);
           $photo = $user->imageUrl();
           $reply = 0;
           $vote = 0;
           $voteStatus = 0;
           $spam = 0;
 
           if(Auth::user()){
               $voteByUser = CommentVote::where('comment_id',$key->id)
                   ->where('user_id',Auth::user()->id)
                   ->first();
               $spamComment = CommentSpam::where('comment_id',$key->id)
                   ->where('user_id',Auth::user()->id)
                   ->first();              
 
               if($voteByUser){
                   $vote = 1;
                   $voteStatus = $voteByUser->vote;
               }
               
               if($spamComment){
                   $spam = 1;
               }
           }          
 
           if(sizeof($replies) > 0){
               $reply = 1;
           }
 
           if(!$spam){
               array_push($commentsData,[
                   "name" => $name,
                   "photo_url" => (string)$photo,
                   "commentid" => $key->id,
                   "comment" => $key->content,
                   "votes" => $key->votes,
                   "reply" => $reply,
                   "votedByUser" =>$vote,
                   "vote" =>$voteStatus,
                   "spam" => $spam,
                   "replies" => $replies,
                   "date" => $key->created_at->toDateTimeString()
               ]);
 
           }       
 
       }
 
       $collection = collect($commentsData);
 
       return $collection->sortBy('votes');
 
    }
 
    protected function replies(Comment $comment)
    {
       $comments = Comment::where('reply_id', $comment->id)->get();
       $replies = [];
       foreach ($comments as $key) {
           $user = User::find($key->user_id);
           $name = $user->name;
           $photo = $user->imageUrl();
           $vote = 0;
           $voteStatus = 0;
           $spam = 0;        
           if(Auth::user()){
               $voteByUser = CommentVote::where('comment_id',$key->id)
                   ->where('user_id', Auth::user()->id)
                   ->first();
               $spamComment = CommentSpam::where('comment_id',$key->id)
                   ->where('user_id',Auth::user()->id)
                   ->first();
               
               if($voteByUser){
                   $vote = 1;
                   $voteStatus = $voteByUser->vote;
               }
 
               if($spamComment){
                   $spam = 1;
               }
 
           }
 
           if(!$spam){        
               array_push($replies,[
                   "name" => $name,
                   "photo_url" => $photo,
                   "commentid" => $key->id,
                   "comment" => $key->content,
                   "votes" => $key->votes,
                   "votedByUser" => $vote,
                   "vote" => $voteStatus,
                   "spam" => $spam,
                   "date" => $key->created_at->toDateTimeString()
               ]);
 
            }

           $collection = collect($replies);

           return $collection->sortBy('votes');

        }
    }
    /**
     * Store a comment
     *
     * @param  Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function store2(Request $request, Blog $blog)
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
