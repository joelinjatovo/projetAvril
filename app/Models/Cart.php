<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

use App\Notifications\NewOrder;
use App\Notifications\OrderPaid;
use App\Notifications\Order;

class Cart extends BaseModel
{

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'carts';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity', 'price', 'currency', 'cart_id', 'product_id', 'author_id'
    ];
    
    protected static $instance = null;
    
    /**
     * Scope a query to only include orders of a given $status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }
    
    
	/*
	Si le panier contient déjà quelque chose, on initialise avec les
	actuels
	*/
	public static function getInstance($currentCard){
		if ($currentCard) {
            self::$instance = Cart::find($currentCard->id);
		}
        
        if (!self::$instance) {
            self::$instance = new Cart();
            self::$instance->author_id = (Auth::check()?Auth::user()->id:0);
            self::$instance->status = 'pinged';
            self::$instance->save();
        }
        
        return self::$instance;
	}
    
	/*
	*id du produit et le produit lui même
	*/
	public static function add($product, $apl, $afa){        
        // One product item
        $storedItem = new CartItem();
        $storedItem->quantity = 0;
        $storedItem->price = $product->price;
        $storedItem->cart_id = self::$instance->id;
        $storedItem->afa_id = $afa->id;
        $storedItem->apl_id = $apl->id;
        $storedItem->product_id = $product->id;
        $storedItem->author_id = (Auth::check()?Auth::user()->id:0);
        
        foreach(self::$instance->items as $item){
            if($item->product_id==$product->id){
                if($product->quantity==1){
                    throw new \Exception("Votre carte contient deja ce produit.");
                }else{
                    $storedItem = $item;
                }
                break;
            }
        }
        
        $tma = max(option('payment.percent_reservation', 0.10), $product->tma);
        
		$storedItem->quantity++;
		$storedItem->price = $storedItem->quantity * $product->price;
		$storedItem->tma = $storedItem->price*$tma;
		$storedItem->currency = $product->currency;
        $storedItem->save();
        
		self::$instance->totalQuantity++;
		self::$instance->totalPrice += $product->price;
		self::$instance->totalTma += $product->price*$tma;
        self::$instance->save();
        
        try{
            $apl->notify(new Order($apl));
        }catch(\Exception $e){}
        
        try{
            $afa->notify(new Order($apl));
        }catch(\Exception $e){}
        
        try{
            \Auth::user()->notify(new Order($apl));
        }catch(\Exception $e){}
        
        try{
            // Notify Admin
            $adminId = option('site.admin', 1);
            $admin = User::find($adminId);
            if($admin){
                $admin->notify(new Order($admin));
            }
        }catch(\Exception $e){}
	}

	public static function reduceByOne($product){
		self::$instance->totalQuantity--;
		self::$instance->totalPrice -= $product->price;
        self::$instance->save();
        
        foreach(self::$instance->items as $item){
            if($item->product_id==$product->id){
                $item->quantity--;
                $item->price -= $product->price;
                if($item->quantity>0)
                    $item->save();
                else
                    $item->delete();
            }
        }
        
	}

	public static function deleteAll($product){
        foreach(self::$instance->items as $item){
            if($item->product_id==$product->id){
                self::$instance->totalQuantity-=$item->quantity;
                self::$instance->totalPrice-=$item->price;
                self::$instance->save();
                
                $item->delete();
            }
        }
	}
    
    
    /**
     * Set status as ordered
     *
     */
    public function setAsOrdered()
    {
        $this->status = 'ordered';
        $this->save();
        
        foreach($this->items as $item){
            $item->status = 'ordered';
            $item->save();
            
            // Update product quantity
            if($item->product){
                $item->product->quantity -= $item->quantity;
                $item->product->buyer_id = $this->author_id;
                $item->product->save();
            }
            
            // Notify AFA
            if($item->afa){
                try{
                    $item->afa->notify(new NewOrder($item->afa, $this, $item));
                }catch(\Exception $e){}
            }
            
            // Notify APL
            if($item->apl){
                try{
                    $item->apl->notify(new NewOrder($item->apl, $this, $item));
                }catch(\Exception $e){}
            }
        }
        
        // Notify Customer
        if($this->author){
            try{
                $this->author->notify(new NewOrder($this->author, $this, null));
            }catch(\Exception $e){}
        }
        
        // Notify Admin
        $adminId = option('site.admin', 1);
        $admin = User::find($adminId);
        if($admin){
            try{
                $admin->notify(new NewOrder($admin, $this, null));
            }catch(\Exception $e){}
        }
        
    }
    
    
    /**
     * Set status as ordered
     *
     */
    public function setAsPaid()
    {
        $this->status = 'paid';
        $this->save();
        
        if($this->author){
            try{
                $this->author->notify(new OrderPaid($this->author, $this, null));
            }catch(\Exception $e){}
        }
        
        // Notify Admin
        $adminId = option('site.admin', 1);
        $admin = User::find($adminId);
        if($admin){
            try{
                $admin->notify(new OrderPaid($admin, $this, null));
            }catch(\Exception $e){}
        }
    }
    
    /**
     * An many user can have many products from carts_items table
     *
     * @return \Illuminate\Database\Eloquent\Relations\ManyToMany
     */
    public function products()
    {
      return $this->belongsToMany(Product::class, 'carts_items', 'cart_id', 'product_id');
    }
    
    /**
     * A cart can have many items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
      return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
    
    /**
     * Get the author record associated with the cart.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}