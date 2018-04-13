<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
use App\Models\User;

// Eloquent Model to manage blog's comment
class Comment extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';
   
    /**
     * Get the blog who owns comment.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
    
    /**
     * Get the author who owns comment.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
