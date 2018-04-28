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
    
    /*
    * Description : Calcul de la distance entre 2 points en fonction de leur latitude/longitude
    *
    * @param Localization $location
    * @param mixed $unity
    * @return Double
    */
    function getDistance(Localisation $location, $unit = 'km') {
        $point1_lat = $this->latitude;
        $point1_long = $this->longitude;
        $point2_lat = $location->latitude;
        $point2_long = $location->longitude;
        
        // Calcul de la distance en degrés
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

        // Conversion de la distance en degrés à l'unité choisie (kilomètres, milles ou milles nautiques)
        switch($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 degré = 111,13384 km, sur base du diamètre moyen de la Terre (12735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 degré = 69,05482 milles, sur base du diamètre moyen de la Terre (7913,1 milles)
                break;
            case 'nmi':
                $distance =  $degrees * 59.97662; // 1 degré = 59.97662 milles nautiques, sur base du diamètre moyen de la Terre (6,876.3 milles nautiques)
        }
        return round($distance, $decimals);
    }
}
