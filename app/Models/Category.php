<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage Product's Category list
class Category extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content'];
}
