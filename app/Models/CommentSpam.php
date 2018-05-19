<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentSpam extends Model
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
}
