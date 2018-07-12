<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

use Auth;

use App\Notifications\ShopNewOrder;
use App\Notifications\ShopAfaSelected;
use App\Notifications\ShopTmaPaid;

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
        
        $tma = max(option('payment.commission_sur_vente', 0), $product->tma);
        $mio = $apl->isMaj()?option('payment.taux_mio_maj', 0):option('payment.taux_mio_nor', 0);
        $cpc = option('payment.commission_presentation_client', 0);
        
        $line = new Order();
        $line->apl_id      = $apl->id;
        $line->product_id  = $product->id;
		$line->price       = $product->price;
		$line->reservation = $product->price*($reservation/100);
		$line->tma         = $product->price*($tma/100);
		$line->apl_amount  = $line->tma*($mio/100);
		$line->afa_amount  = $line->tma*($cpc/100) - $line->reservation;
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
        $this->reserved_at = \Carbon\Carbon::now();
        $this->save();
        
        // Update product buyers
        if($this->product){
            $this->product->status = 'ordered';
            $this->product->buyer_id = $this->author_id;
            $this->product->save();
        }
        
        $notification = new ShopNewOrder($this)
        $this->notify($notification);
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
        
        $notification = new ShopAfaSelected($this)
        $this->notify($notification);
    }
    
    /**
     * Payer Commission sur ventes
     *
     */
    public function setTmaPaid()
    {
        $this->tma_paid_at = \Carbon\Carbon::now();
        $this->save();
        
        $notification = new ShopTmaPaid($this)
        $this->notify($notification);
    }
    
    /**
     * Payer AFA
     *
     */
    public function setAfaPaid()
    {
        $this->afa_paid_at = \Carbon\Carbon::now();
        $this->save();
        
        $notification = new ShopAfaPaid($this)
        $this->notify($notification);
    }
    
    /**
     * Payer APL
     *
     */
    public function setAplPaid()
    {
        $this->apl_paid_at = \Carbon\Carbon::now();
        $this->save();
        
        $notification = new ShopAplPaid($this)
        $this->notify($notification);
    }
    
    /**
     * Cancelling order
     *
     */
    public function setAsCancelled()
    {
        $this->status = 'cancelled';
        $this->cancelled_by = \Auth::user()->id;
        $this->cancelled_by_role = \Auth::user()->role;
        $this->cancelled_at = \Carbon\Carbon::now();
        $this->save();
        
        $notification = new ShopOrderCancelled($this)
        $this->notify($notification);
    }
    
    /**
     * Confirm order
     *
     */
    public function setAsConfirmed()
    {
        $this->confirmed_by = \Auth::user()->id;
        $this->confirmed_by_role = \Auth::user()->role;
        $this->confirmed_at = \Carbon\Carbon::now();
        $this->save();
        
        $notification = new ShopOrderConfirmed($this)
        $this->notify($notification);
    }
    
    private function notify(Notification $notification){
        if(!$notification){
            return;
        }
        foreach($this->notifiable() as $user){
            if($user){
                try{
                    $notification->setUser($user);
                    $user->notify($notification);
                }catch(\Exception $e){}
            }
        }
    }
    
    private function notifiable(){
        yield $this->author;
        yield $this->afa;
        yield $this->apl;
        yield User::find(option('site.admin', 1));
    }
}
