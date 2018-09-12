<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observation extends BaseModel
{    
    use SoftDeletes;

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'observations';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'user_id', 'author_id',
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
     * Excerpt
     *
     * @param int $length
     * @return String
     */
    public function excerpt($length = 100)
    {
        return substr($this->content, 0, $length);
    }
    
    /**
     * An observation have one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
      return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    /**
     * An observation have one author
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
      return $this->hasOne(User::class, 'id', 'author_id');
    }
}
