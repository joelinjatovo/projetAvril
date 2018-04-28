<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

// Eloquent Model to manage Blog
class Blog extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'title', 'content', 'status', 'image', 'post_type', 'author_id',];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->author_id = (Auth::check()?Auth::user()->id:0);
    }
    
    /**
     * Excerpt
     *
     * @param int $length
     * @return String
     */
    public function excerpt($length = 100)
    {
        return substr($this->content, 0, $length);
    }
    
    /**
     * Get Url of Attached Image OR Default Image
     *
     * @param Boolean $thumb
     * @return String
     */
    public function imageUrl($thumb=false)
    {
        // Image is setted
        if($this->image){
            if($thumb) return thumbnail($this->image->filepath);
            return storage($this->image->filepath);
        } 
        return asset('images/blog.png');
    }
    
    
    /**
     * A blog can have many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
      return $this->hasMany(Comment::class, 'blog_id', 'id');
    }
    
    /**
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

}
