<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

use App\Models\User;
use App\Models\Category;

// Eloquent Model to manage Product's Category list
class Category extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'title', 'content'];
    
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
     * A category can have one author
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
      return $this->hasOne(User::class, 'author_id', 'id');
    }
    
    /**
     * A category can have one parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
      return $this->hasOne(Category::class, 'parent_id', 'id');
    }
}
