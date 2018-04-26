<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    

    // after the class declaration add this code snippet:
    use HasManyMetaDataTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image_id', 'location_id', 'status', 'type', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $events = [
        'saved' => UserSaved::class,
        'deleted' => UserDeleted::class,
    ];
    
    /**
     * Scope a query to only include users of a given $role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfRole($query, $role)
    {
        return $query->where('role', $role);
    }
    
    /**
     * A user is admin || AFA || APL || member
     *
     * @return Boolean
     */
    public function hasRole($role)
    {
      return ($this->role == $role);
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
     * A user can have one parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
      return $this->hasOne(User::class, 'author_id', 'id');
    }
    
    /**
     * A user can have one location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
      return $this->hasOne(Localisation::class, 'id', 'location_id');
    }
    
    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
      return $this->hasMany(ChatMessage::class, 'user_id', 'id');
    }
    
    /**
     * An admin user can have many blogs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogs()
    {
      return $this->hasMany(Blog::class, 'author_id', 'id');
    }
    
    /**
     * A user can have many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
      return $this->hasMany(Comment::class, 'author_id', 'id');
    }
    
    /**
     * An admin can have many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
      return $this->hasMany(Product::class, 'author_id', 'id');
    }
    
    /**
     * An many user can have many products from labels table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function clientProductLabeled()
    {
      return $this->belongsToMany(Product::class, 'labels', 'author_id', 'product_id');
    }
    
    /**
     * A seller can have many products from rows_products table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function sellerProducts()
    {
      return $this->belongsToMany(Product::class, 'rows_products', 'seller_id', 'product_id');
    }
    
    /**
     * A user can have many products from products_labels table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function labels()
    {
      return $this->belongsToMany(Product::class, 'products_labels', 'author_id', 'product_id');
    }
    
}
