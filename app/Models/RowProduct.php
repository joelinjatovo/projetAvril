<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;
use Auth;

use App\Models\User;
use App\Models\Product;

// Eloquent\Model to manage relation bettween seller and their product
class RowProduct extends Model
{
    
    // after the class declaration add this code snippet:
    use HasManyMetaDataTrait;
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rows_products';
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->author_id = (Auth::check()?Auth::user()->id:0);
        $this->seller_id = (Auth::check()?Auth::user()->id:0);
    }
    
    /**
     * Get the product record associated with this row.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
    /**
     * Get the seller record associated with this row.
     * This is the seller
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
    
    /**
     * Get the author record associated with this row.
     * This is the seller
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
