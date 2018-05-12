<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;
use Auth;

// Eloquent\Model to manage Product and Service to sell
class Product extends BaseModel
{
    use HasManyMetaDataTrait;
    
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'reference', 'slug', 'price', 'tma', 'image_id', 'location_id', 'status',
    ];
    
    /**
     * The attributes that are in meta table.
     *
     * @var array
     */
    protected $metas = [
        'title', 'content', 'reference', 'slug', 'price', 'tma', 'image_id', 'location_id', 'status',
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
     * Scope a query to only include products of a given $status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }
    
    /**
     * Check if product is disponible (quantity>0)
     *
     * @return Boolean
     */
    public function isDisponible()
    {
        return ($this->quantity>0 && $this->status=='published');
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
     * Get Url of Attached Image OR Default Image
     *
     * @param Boolean $thumb
     * @return String
     */
    public function imageUrl($thumb=false)
    {
        // Image is setted
        if($this->image){
            if($thumb) return thumbnail($this->image->filepath);
            return storage($this->image->filepath);
        } 
        return asset('images/product.png');
    }
    
    /**
     * Get the type record associated with the product.
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id')
            ->ofObject('type');
    }
    
    /**
     * Get the location type record associated with the product.
     */
    public function locationType()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id')
            ->ofObject('location');
    }
    
    /**
     * Get the image record associated with the product.
     */
    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
    
    /**
     * A product can have many images
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function images()
    {
      return $this->belongsToMany(Image::class, 'products_images', 'product_id', 'image_id');
    }
    
    /**
     * Get the seller record associated with the product.
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
    
    /**
     * Get the author record associated with the product.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
    /**
     * A product can have one category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
      return $this->hasOne(Category::class, 'id', 'category_id');
    }
    
    /**
     * A product can have many categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function categories()
    {
      return $this->belongsToMany(Product::class, 'objects_categories', 'product_id', 'category_id');
    }
    
    
    /**
     * A product can have one location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
      return $this->hasOne(Localisation::class, 'id', 'location_id');
    }
    
}
