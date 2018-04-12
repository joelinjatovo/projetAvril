<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent\Model to manage product saved and starred
class ProductLabel extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_label';
}
