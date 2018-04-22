<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage Page list
class Image extends Model
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
}
