<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent\Model to manage Product and Service to sell
class Product extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
}
