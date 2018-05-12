<?php

namespace App\Models;

use Auth;

class ProductImage extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products_images';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'image_id', 'author_id'];
    
    
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
     * A line can have one product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
      return $this->hasOne(Product::class, 'product_id', 'id');
    }
    
    
    /**
     * A line can have one product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
      return $this->hasOne(Image::class, 'image_id', 'id');
    }
    
}
