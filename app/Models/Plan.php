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
    protected $fillable = ['name', 'slug', 'name', 'cost', 'description', 'role'];
    
    public function getRouteKeyName()
    {
        if(\Auth::check() && \Auth::user()->isAdmin())
            return 'id';
        return 'slug';
    }
}
