<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;
use Auth;
use App;

// Eloquent Model to manage Page list
class Page extends BaseModel
{
    use HasManyMetaDataTrait;
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content', 'path', 'parent_id', 'page_order'];
    
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
     * Scope a query to only include pages of a current language.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLocale($query)
    {
        return $query->where('language', App::getLocale());
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
     * Get the author record associated with the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'author_id', 'id');
    }
    
    /**
     * Get the parent record associated with the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(Page::class, 'parent_id', 'id');
    }
    
    /**
     * Get the childs record associated with the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id')
            ->locale($this->language);
    }
    
    /**
     * An many page can have many pubs from pubs_pages table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function pubs()
    {
      return $this->belongsToMany(Pub::class, 'pubs_pages', 'page_id', 'pub_id');
    }
}
