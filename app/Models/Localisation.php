<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage Latitude,Longitude, City, Country, etc
class Localisation extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localizations';
}
