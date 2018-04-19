<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use APp\Models\User;
use APp\Models\RowProduct;

// Eloquent\Model to manage product saved and starred
class ProductLabel extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products_labels';
    
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
     * Get the product record associated.
     */
    public function rowProduct()
    {
        return $this->belongsTo(RowProduct::class, 'row_product_id', 'id');
    }
    
    /**
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
