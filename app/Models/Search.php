<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends BaseModel
{
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'searches';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'author_id'
    ];

    /**
     * The attributes that should be a date
     *
     * @var array
     */
    protected $dates = ['saved_at'];
    
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->author_id = (\Auth::check()?\Auth::user()->id:0);
    }
    
    /**
     * A user can have one parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
      return $this->hasOne(User::class, 'id', 'author_id');
    }
}
