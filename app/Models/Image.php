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
        $name = md5(time()).'.'.$file->getClientOriginalExtension();
        $album = 'app';
        $dir = public_path('uploads/'.$album);
        
        $newFile = $file->move($dir, $name);
        
        $image = new Image();
        $image->filename = $name;
        $image->filemime = $file->getClientMimeType();
        $image->filepath = $album.'/'.$name;
        $image->save();
        return $image;
    }
    
    /**
     * Get Url of Image OR Default Image
     *
     * @param Boolean $thumb
     * @return String
     */
    public function imageUrl($thumb=false)
    {
        // Image is setted
        if($thumb) return thumbnail($this->filepath);
        return storage($this->filepath);
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
