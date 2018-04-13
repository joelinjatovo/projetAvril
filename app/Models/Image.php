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
    protected $fillable = ['title', 'content'];
}
