<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage all basic config of the application
class Config extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configs';
}
