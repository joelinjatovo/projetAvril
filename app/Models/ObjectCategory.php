<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;

// Eloquent Model to manage Product's ObjectCategory list
class ObjectCategory extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'objects_categories';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id', 'object_id', 'object_type', 'author_id'];
    
    
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
