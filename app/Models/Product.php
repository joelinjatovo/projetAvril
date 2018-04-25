<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

// Eloquent\Model to manage Product and Service to sell
class Product extends BaseModel
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
        'title', 'content', 'reference', 'slug', 'price', 'tma', 'image_id', 'status',
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
        return asset('images/product.png');
    }
    
    /**
     * Get the image record associated with the product.
     */
    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
    
    /**
     * Get the seller record associated with the product.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
    
    /**
     * Get the author record associated with the product.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
}
