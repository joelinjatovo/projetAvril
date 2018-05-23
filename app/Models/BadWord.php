<?php

namespace App\Models;

class BadWord extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'badwords';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content'];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
