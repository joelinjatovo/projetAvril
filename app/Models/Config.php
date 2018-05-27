<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;

// Eloquent Model to manage all basic config of the application
class Config extends BaseModel
{

    // after the class declaration add this code snippet:
    use HasManyMetaDataTrait;
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configs';
    
    public static $SITE_ID = 1;
    public static $SOCIAL_ID = 2;
    public static $PAYMENT_ID = 3;
    public static $STYLE_ID = 4;
    public static $LOGIN_ID = 5;
    public static $SMTP_ID = 6;
    
    public static $TRIAL = "payment.trial_delay";
    public static $RESERVATION = "payment.percent_reservation";
    
    public static $APP_LATITUDE = "site.latitude";
    public static $APP_LONGITUDE = "site.longitude";
    
    public static function site(){
        return Config::findOrFail(self::$SITE_ID);
    }
    
    public static function siteRules(){
        return [
            'latitude' => 'required|max:100',
            'longitude' => 'required|max:100',
            
            'admin_email' => 'required|max:100',
            'admin_phone' => 'required|max:100',
            'admin_name' => 'required|max:100',
            
            'meta_title'    => 'required|max:100',
            'meta_desc'     => 'required|max:500',
            'meta_keywords' => 'required|max:500',
        ];
    }
    
    public static function login(){
        return Config::findOrFail(self::$LOGIN_ID);
    }
    
    public static function loginRules(){
        return [
            'title.*' => 'required|max:200',
            'content.*' => 'required|max:1000',
            'address.*' => 'required|max:500',
            'contact.*' => 'required|max:500',
        ];
    }
    
    public static function loginKeys(){
        return [
            'title',
            'content',
            'address',
            'contact',
        ];
    }
    
    public static function smtp(){
        return Config::findOrFail(self::$SMTP_ID);
    }
    
    public static function smtpRules(){
        return [
            'title' => 'required|max:100',
        ];
    }
    
    public static function social(){
        return Config::findOrFail(self::$SOCIAL_ID);
    }
    
    public static function socialRules(){
        return [
            'facebook' => 'max:100',
            'twitter' => 'max:100',
            'googleplus' => 'max:100',
            'linkedin' => 'max:100',
            'tumblr' => 'max:100',
            'youtube-play' => 'max:100',
            'pinterest' => 'max:100',
            'vimeo' => 'max:100',
        ];
    }
    
    public static function socialTitles(){
        return [
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'googleplus' => 'Google+',
            'linkedin' => 'LinkedIn',
            'tumblr' => 'Tumblr',
            'youtube' => 'YouTube',
            'pinterest' => 'Pinterest',
            'vimeo' => 'Vimeo',
        ];
    }
    
    public static function style(){
        return Config::findOrFail(self::$STYLE_ID);
    }
    
    public static function payment(){
        return Config::findOrFail(self::$PAYMENT_ID);
    }
    
    public static function paymentRules(){
        return [
            'value_inscription_member' => 'required|max:100',
            'value_inscription_seller' => 'required|max:100',
            'value_inscription_afa' => 'required|max:100',
            'value_inscription_apl' => 'required|max:100',

            'percent_reservation' => 'required|max:100',

            'percent_presentation_afa' => 'required|max:100',
            'percent_presentation_apl' => 'required|max:100',

            'disable_payed_inscription' => 'max:100',
            'trial_delay' => 'required|max:100',
        ];
    }
    
    public function get_meta_array($key, $index, $default = ''){
        $meta = $this->get_meta($key);
        if(!$meta) return $default;
        
        $value = unserialize($meta->value);
        if(!isset($value[$index])) return $default;

        return $value[$index];
        
    }
    
    public function update_meta_array($key, $value){
        $value = serialize($value);
        $meta = $this->update_meta($key, $value);
    }
}
