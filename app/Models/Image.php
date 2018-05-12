<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage Page list
class Image extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['filename', 'filemime', 'filepath'];
    
    static function storeAndSave($file){
        $path = $file->store('uploads');
        $image = new Image();
        $image->filename = '';
        $image->filemime = '';
        $image->filepath = $path;
        $image->save();
        return $image;
    }
    
    
    /**
     * A image can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function products()
    {
      return $this->belongsToMany(Product::class, 'products_images', 'image_id', 'product_id');
    }
}
