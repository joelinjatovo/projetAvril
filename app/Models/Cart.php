<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

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
    
	/*
	Si le panier contien déjà quelque chose, on initialise avec les
	actuels
	*/
	public function __construct($currentCard){
		if ($currentCard) {
			$this->id = $currentCard->id;
			$this->totalPrice = $currentCard->totalPrice;
			$this->totalQuantity = $currentCard->totalQuantity;
		}
        
        $this->author_id = (Auth::check()?Auth::user()->id:0);
        $this->status = 'encours';
	}

	/*
	*id du produit et le produit lui même
	*/
	public function add($product){
        // One product item
        $storedItem = new CartItem();
        $storedItem->quantity = 0;
        $storedItem->price = $product->price;
        $storedItem->cart_id = $this->id;
        $storedItem->product_id = $product->id;
        $storedItem->author_id = (Auth::check()?Auth::user()->id:0);
        
        foreach($this->items as $item){
            if($item->product_id==$product->id){
                $storedItem = $item;
                break;
            }
        }
        
		$storedItem->quantity++;
		$storedItem->price = $storedItem->quantity * $product->price;
        $storedItem->save();
        
		$this->totalQuantity++;
		$this->totalPrice += $product->price;
        $this->save();
	}

	public function reduceByOne($product){
		$this->totalQuantity--;
		$this->totalPrice -= $product->price;
        
        foreach($this->items as $item){
            if($item->product_id==$product->id){
                $item->quantity--;
                $item->price -= $product->price;
                if($item->quantity>0)
                    $item->save();
                else
                    $item->delete();
                return true;
            }
        }
        
        return false;
	}

	public function delete($product){
        foreach($this->items as $item){
            if($item->product_id==$product->id){
                $this->totalQuantity-=$item->quantity;
                $this->totalPrice-=$item->price;
                $this->delete();
                return true;
            }
        }
        return false;
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