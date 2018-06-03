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
     * Show the row comment at the back.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Comment $comment)
    {
        $comment->load('replies')->withCount('replies');
        
        return view('admin.comment.index')
            ->with('item', $comment);
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
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->blog_id = $request->blog_id?$request->blog_id:0;
        $comment->reply_id = $request->reply_id?$request->reply_id:0;
        $comment->save();
        
        //$comment = Comment::create($request->all());
 
        return [ "status"  => "true",
                 "id"      => $comment->id ,
                 "content" => $comment->content 
               ];
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  $comment
    * @param  $action
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Comment $comment, $action)
    {
       if($action == "vote"){     
           /*
           $this->validate($request, [
                'vote' => 'required',
                'user_id' => 'required',
           ]);
           */
 
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
           
           try{
               $commentVote = new CommentVote();
               $commentVote->comment_id = $comment->id?$comment->id:0;
               $commentVote->user_id = $request->user_id;
               $commentVote->vote = $request->vote;
               $commentVote->save();
           }catch(\Exception $e){
               return $e->getMessage();
           }
           
           return "true";
 
       }
 
       if($action == "spam"){
           /*
           $this->validate($request, [
               'user_id' => 'required',
           ]);
           */
 
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
    * Get Comments for blog
    *
    * @return Comments
    */
    public function index(Blog $blog)
    {
       $comments = Comment::where('blog_id', $blog->id)
           ->with('user')
           ->get();
       $commentsData = [];
       foreach ($comments as $comment) {
           $user = $comment->user;
           $name = $user->name;
           $replies = $this->replies($comment);
           $photo = $user->imageUrl();
           $reply = 0;
           $vote = 0;
           $voteStatus = 0;
           $spam = 0;
 
           if(Auth::user()){
               $voteByUser = CommentVote::where('comment_id', $comment->id)
                   ->where('user_id', Auth::user()->id)
                   ->first();
               $spamComment = CommentSpam::where('comment_id', $comment->id)
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
                   "id"        => $comment->id,
                   "comment"   => $comment->content,
                   "votes"     => $comment->votes,
                   "reply"     => $reply,
                   "votedByUser" =>$vote,
                   "vote"      =>$voteStatus,
                   "spam"      => $spam,
                   "replies"   => $replies,
                   "date"      => $comment->created_at->toDateTimeString()
               ]);
 
           }       
 
       }
 
       $collection = collect($commentsData);
 
       return $collection->sortBy('votes');
 
    }
 
    protected function replies(Comment $comment)
    {
       $comments = Comment::where('reply_id', $comment->id)
           ->with('user')
           ->get();
       $replies = [];
       foreach ($comments as $item) {
           $user = $item->user;
           $name = $user->name;
           $photo = $user->imageUrl();
           $vote = 0;
           $voteStatus = 0;
           $spam = 0;        
           if(Auth::user()){
               $voteByUser = CommentVote::where('comment_id', $item->id)
                   ->where('user_id', Auth::user()->id)
                   ->first();
               $spamComment = CommentSpam::where('comment_id', $item->id)
                   ->where('user_id', Auth::user()->id)
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
                   "name"      => $name,
                   "photo_url" => $photo,
                   "id"        => $item->id,
                   "content"   => $item->content,
                   "votes"     => $item->votes,
                   "votedByUser" => $vote,
                   "vote"      => $voteStatus,
                   "spam"      => $spam,
                   "date"      => $item->created_at->toDateTimeString()
               ]);
 
            }

           $collection = collect($replies);

           return $collection->sortBy('votes');

        }
    }
    
    /**
     * Show the list of comments
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
            ->withCount('replies');
        switch($filter){
            case 'archived':
            case 'trashed':
            case 'published':
            case 'pinged':
                $items = $items->where('status', $filter);
                $title = __('app.comment.list.status', ['status'=>__('app.'.$filter)]);
                break;
            case 'all':
                $title = __('app.comment.list');
                break;
        }
        
        $items = $items->paginate($this->pageSize);
        
        return view('admin.comment.all')
            ->with('title', $title)
            ->with('items', $items)
            ->with('filter', $filter)
            ->with('blog', $blog)
            ->with('page', $page)
            ->with('breadcrumbs', $title);
    }
    
    
    /**
    * Publish $comment
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function publish(Request $request, Comment $comment)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $comment->status = 'published';
        $comment->save();
        
        return back()->with('success',"La commentaire a été publiée avec succés");
        return back()->with('success',"La commentaire a été publiée avec succés");
    }
    
    /**
    * Save $comment in archive
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function archive(Request $request, Comment $comment)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $comment->status = 'archived';
        $comment->save();
        
        return back()->with('success',"La commentaire a été archivée avec succés");
    }
    
    /**
    * Restore trashed product
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function restore(Request $request, Comment $comment)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $comment->status = 'pinged';
        $comment->save();
        
        return back()->with('success',"Le produit a été restoré avec succés");
    }
    
    /**
    * Trash product
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function trash(Request $request, Comment $comment)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $comment->status = 'trashed';
        $comment->save();
        
        return back()->with('success',"La commentaire a été ajoutée au corbeille avec succés");
    }
    
    /**
    * Delete Produt
    *
    * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Product  $product
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, Comment $comment)
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
        
        $comment->delete();
        
        return redirect()->route('admin.dashboard')
            ->with('success',"La commentaire a été supprimée avec succés");
    }
}
