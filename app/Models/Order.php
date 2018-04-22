<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Order extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    
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
     * Get the cart record associated with the order.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
    
    /**
     * Get the author record associated with the order.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
