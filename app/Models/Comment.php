<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage blog's comment
class Comment extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';
   
}
