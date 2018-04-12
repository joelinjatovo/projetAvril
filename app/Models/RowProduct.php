<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent\Model to manage relation bettween seller and their product
class RowProduct extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'row_product';
}
