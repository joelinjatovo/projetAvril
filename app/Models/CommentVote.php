<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class CommentVote extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment_user_vote';
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment_id', 'user_id', 'vote'];

    /**
     * The attributes that should be a date
     *
     * @var array
     */
    protected $dates = false;
    
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
