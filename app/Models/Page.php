<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage Page list
class Page extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'link', 'params'];
}
