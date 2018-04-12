<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent\Model to manage relation bettween member and their product (saved product OR starred product)
class UserProduct extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_product';
}
