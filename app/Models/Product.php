<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

use App\Models\Product;
use App\Models\User;


// Eloquent\Model to manage Product and Service to sell
class Product extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'reference', 'slug',
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
    
    /**
     * A user can have many categories from products_categories table
     */
    /*
    public function rowProducts()
    {
      return $this->belongsToMany(Product::class, 'products_categories', 'product_id', 'category_id');
    }
    */
    
    /**
     * Get the author record associated with the blog.
     */
    /*
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    */
    
}
