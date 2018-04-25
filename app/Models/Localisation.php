<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Eloquent Model to manage Latitude,Longitude, City, Country, etc
class Localisation extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'country', 'state', 'city', 'postalCode', 'locality', 'longitude', 'latitude', 'altitude',
    ];
}
