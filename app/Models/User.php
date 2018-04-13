<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use AstritZeqiri\Metadata\Traits\HasManyMetaDataTrait;

use App\Models\ChatMessage;
use App\Models\Blog;
use App\Models\Product;
use App\Models\RowProduct;
use App\Models\ProductLabel;
use App\Models\Pub;
use App\Models\Page;
use App\Models\Comment;

class User extends Authenticatable
{
    use Notifiable;
    

    // after the class declaration add this code snippet:
    use HasManyMetaDataTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * A user is admin || AFA || APL || member
     *
     * @return Boolean
     */
    public function hasRole($role)
    {
      return ($this->role == $role);
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
      return $this->hasMany(Blog::class, 'user_id', 'id');
    }
    
    /**
     * A user can have many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
      return $this->hasMany(Comment::class, 'user_id', 'id');
    }
    
    /**
     * A user can have many pubs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pubs()
    {
      return $this->hasMany(Pub::class, 'user_id', 'id');
    }
    
    /**
     * A user can have many pages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
      return $this->hasMany(Page::class, 'user_id', 'id');
    }
    
    /**
     * A user can have many products from product_label table
     */
    public function labeledProducts()
    {
      return $this->belongsToMany(Product::class, 'product_label', 'user_id', 'product_id');
    }
    
    /**
     * A user can have many products from row_product table
     */
    public function rowProducts()
    {
      return $this->belongsToMany(Product::class, 'row_product', 'user_id', 'product_id');
    }
    
}
