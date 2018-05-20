<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class CommentSpam extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment_spam';
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment_id', 'user_id'];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user_id = (Auth::check()?Auth::user()->id:0);
    }
    
}
