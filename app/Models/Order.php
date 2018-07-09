<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Notifications\NewOrder;
use App\Notifications\AfaSelected;
use Auth;

// Eloquent\Model to manage Product and Service to sell
class Order extends BaseModel
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    /**
     * The attributes that should be a date
     *
     * @var array
     */
    protected $dates =  ['afa_selected_at','apl_paid_at', 'afa_paid_at', 'cancelled_at'];
    
    
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
     * Get the product record associated with the cart item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
    /**
     * Get the apl record associated with the cart item.
     */
    public function apl()
    {
        return $this->belongsTo(User::class, 'apl_id', 'id');
    }
    
    /**
     * Get the afa record associated with the cart item.
     */
    public function afa()
    {
        return $this->belongsTo(User::class, 'afa_id', 'id');
    }
    
    /**
     * Get the author record associated with the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
	/*
	* Ajouter le produit dans le panier
	*/
	public static function add($product, $apl, $reservation){
        $line = new Order();
        $line->apl_id      = $apl->id;
        $line->product_id  = $product->id;
		$line->reservation = $reservation;
		$line->price       = $product->price;
		$line->tma         = $product->price*$tma;
		$line->currency    = $product->currency;
        $line->save();
        return $line;
	}
    
    /**
     * Set status as ordered
     *
     */
    public function setAsOrdered()
    {
        $this->status = 'ordered';
        $this->save();
        
        // Update product buyers
        if($this->product){
            $this->product->status = 'ordered';
            $this->product->buyer_id = $this->author_id;
            $this->product->save();
        }
        
        // Notify APL
        if($this->apl){
            try{
                $this->apl->notify(new NewOrder($this->apl, $this));
            }catch(\Exception $e){}
        }
        
        // Notify Customer
        if($this->author){
            try{
                $this->author->notify(new NewOrder($this->author, $this));
            }catch(\Exception $e){}
        }
        
        // Notify Admin
        $adminId = option('site.admin', 1);
        $admin = User::find($adminId);
        if($admin){
            try{
                $admin->notify(new NewOrder($admin, $this));
            }catch(\Exception $e){}
        }
    }
    /**
     * Set status as ordered
     *
     */
    public function setAfa(User $afa)
    {
        $this->afa_id = $afa->id;
        $this->afa_selected_at = \Carbon\Carbon::now();
        $this->save();

        // Notify APL
        if($this->apl){
            try{
                $this->apl->notify(new AfaSelected($this->apl, $this));
            }catch(\Exception $e){}
        }
        
        // Notify AFA
        if($this->afa){
            try{
                $this->afa->notify(new AfaSelected($this->afa, $this));
            }catch(\Exception $e){}
        }
        
        // Notify Customer
        if($this->author){
            try{
                $this->author->notify(new AfaSelected($this->author, $this));
            }catch(\Exception $e){}
        }
        
        // Notify Admin
        $adminId = option('site.admin', 1);
        $admin = User::find($adminId);
        if($admin){
            try{
                $admin->notify(new AfaSelected($admin, $this));
            }catch(\Exception $e){}
        }
    }
    
}
