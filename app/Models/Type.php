<?php

namespace App\Models;

use Auth;

class Type extends BaseModel
{
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'types';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'content', 'object_type', 'author_id',
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
     * Scope a query to only include users of a given $type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfObject($query, $type)
    {
        return $query->where('object_type', $type);
    }
    
    /**
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
    /**
     * A type can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
      return $this->hasMany(Product::class, 'type_id', 'id');
    }
    
}
