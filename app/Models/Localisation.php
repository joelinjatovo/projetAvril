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
        'address', 'street', 'country', 'state',  'suburb', 'city', 'postalCode', 'locality', 'longitude', 'latitude', 'altitude',
    ];
    
    
    /**
     * Return Location String
     *
     * @return String
     */
    public function toString()
    {
        return $this->address.', '. $this->city.', '. $this->country;
    }
}
