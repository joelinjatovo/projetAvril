<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invoice extends BaseModel
{
    use SoftDeletes;
    
    /**
    * Type of invoice
    */
    public static $TYPE_RESERVATION = 'reservation';
    public static $TYPE_TMA = 'tma';
    public static $TYPE_MIO = 'mio';
    public static $TYPE_CPC = 'cpc';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];
    
    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Get price label with currency
     *
     * @return String
     */
    public function getPrice()
    {
        return '$'.$this->amount;
    }
    
    /**
     * An invoice can have one order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
      return $this->hasOne(Order::class, 'id', 'order_id');
    }
    
    /**
     * An invoice can have one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function to()
    {
      return $this->hasOne(User::class, 'id', 'to_id');
    }
    
    /**
     * An invoice can have one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function from()
    {
      return $this->hasOne(User::class, 'id', 'from_id');
    }
}
