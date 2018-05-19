<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
