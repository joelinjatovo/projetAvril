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
     * Get Url of Attached Image OR Default Image
     *
     * @param Boolean $thumb
     * @return String
     */
    public function imageUrl($lang, $thumb=false)
    {
        if($lang=='fr'){
            // Image is setted
            if($this->pub_image){
                if($thumb) return thumbnail($this->pub_image->filepath);
                return storage($this->pub_image->filepath);
            }
        } 
        if($lang=='en'){
            if($this->pub_image_en){
                if($thumb) return thumbnail($this->pub_image_en->filepath);
                return storage($this->pub_image_en->filepath);
            }
        } 
        return asset('images/pub.png');
    }
    
    /**
     * Return title switch selected language
     *
     * @return String
     */
    public function getTitle()
    {
        return (\App::getLocale()=='fr'?$this->title:$this->title_en);
    }
    
    /**
     * Return content switch selected language
     *
     * @return String
     */
    public function getContent()
    {
        return \App::getLocale()=='fr'?$this->content:$this->content_en;
    }
    
    /**
     * Excerpt
     *
     * @param int $length
     * @return String
     */
    public function excerpt($language = 'fr', $length = 100)
    {
        return substr($language=='fr'?$this->content:$this->content_en, 0, $length);
    }
    
    /**
     * Get the author record associated with the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
    
    /**
     * Get the parent record associated with the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(Page::class, 'id', 'parent_id');
    }
    
    /**
     * Get the childs record associated with the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id')
            ->orderBy('page_order' , 'asc')
            ->orderBy('title' , 'asc');
    }
    
    /**
     * Get the image record associated with the pub.
     */
    public function pub_image()
    {
        return $this->belongsTo(Image::class, 'pub_image_id', 'id');
    }
    
    /**
     * Get the image record associated with the pub.
     */
    public function pub_image_en()
    {
        return $this->belongsTo(Image::class, 'pub_image_en_id', 'id');
    }
}
