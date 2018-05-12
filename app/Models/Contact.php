<?php

namespace App\Models;

use Auth;

class Contact extends BaseModel
{
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 
        'home_number', 'work_number', 'mobile_number', 'contact_number', 
        'location_id', 'author_id',
    ];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->author_id = (Auth::check()?Auth::user()->id:0);
    }
    
    /**
     * Get the author record associated with the product.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
    /**
     * Get the location record associated with the contact.
     */
    public function location()
    {
        return $this->belongsTo(Localization::class, 'location_id', 'id');
    }
}
