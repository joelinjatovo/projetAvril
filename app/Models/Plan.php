<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plans';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'cost', 'description', 'role', 'type'];
    
    public function getRouteKeyName()
    {
        if(\Auth::check() && \Auth::user()->isAdmin())
            return 'id';
        return 'slug';
    }
    
    public function getDayCount()
    {
        switch($this->type){
            case 'daily':
                return 1;
            case 'weekly':
                return 7;
            case 'bimonthly':
                return 15;
            case 'monthly':
                return 30;
            case 'yearly':
                return 365;
        }
        return 0;
    }
}
