<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

// Eloquent Model to manage Category
class Category extends BaseModel
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
    protected $fillable = [
        'slug', 'title', 'content', 'author_id',
    ];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->author_id = (Auth::check()?Auth::user()->id:0);
    }
    
    public function getRouteKeyName()
    {
      return 'slug';
    }
    
    /**
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
    /**
     * A category can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
      return $this->hasMany(Product::class, 'category_id', 'id');
    }
    
    /**
     * A category can have many subProducts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subProducts()
    {
      return $this->belongsToMany(Product::class, 'objects_categories', 'category_id', 'object_id')
          ->wherePivot('object_type', Product::class);
    }
    
    /**
     * A category can have many blogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function blogs()
    {
      return $this->belongsToMany(Product::class, 'objects_categories', 'category_id', 'object_id')
          ->wherePivot('object_type', Blog::class);
    }

}
