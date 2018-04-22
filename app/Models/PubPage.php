<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

// Eloquent Model to manage PubPage
class PubPage extends BaseModel
{
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pubs_pages';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id', 'pub_id', 'author_id',
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
}
