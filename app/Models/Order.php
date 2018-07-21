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
    protected $dates =  ['reserved_at', 'afa_selected_at', 'tma_paid_at','apl_paid_at', 'afa_paid_at', 'cancelled_at'];
    
    
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
    
    /**
     * 
     */
    public function isConfirmed()
    {
        return !empty($this->confirmed_at);
    }
    
    /**
     * 
     */
    public function isAfaPaid()
    {
        return !empty($this->afa_paid_at);
    }
    
    /**
     * 
     */
    public function isTmaPaid()
    {
        return !empty($this->tma_paid_at);
    }
    
    /**
     * 
     */
    public function isAplPaid()
    {
        return !empty($this->apl_paid_at);
    }

	/**
	* Ajouter le produit dans le panier
    * Exemple: si le prix de vente est de A$450,000, que la commission sur vente accordée à l'agence immobilière par le vendeur est de 5% sur le prix de vente, que la Commission de Présentation de Clientèle reversée à IEA par l'AFA est de 40% de la commission sur vente, et que le montant de la {Réservation} a été de A$3,000, le montant de la CPC pour cette vente sera de :   (A$450,000 X 5% x 40%) - (A$3,000) = A$6,000.
	*/
	public static function add($product, $apl){
        $reservation = option('payment.taux_de_reservation', 0);
        $tma = max(option('payment.commission_sur_vente', 0), $product->tma);
        $mio = $apl->isMaj()?option('payment.taux_mio_maj', 0):option('payment.taux_mio_nor', 0);
        $cpc = option('payment.commission_presentation_client', 0);
        
        $line = new Order();
        $line->apl_id      = $apl->id;
        $line->product_id  = $product->id;
		$line->price       = $product->price;
		$line->reservation = $product->price*($reservation/100); // raisin admin / aloan client
		$line->tma         = $product->price*($tma/100); // raisin afa / aloan seller
		$line->apl_amount  = $line->tma*($mio/100); // raisin apl  / aloan admin
		$line->afa_amount  = $line->tma*($cpc/100) - $line->reservation; // raisin admin / aloan afa
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
        
        $notification = new ShopNewOrder($this);
        $this->notify($notification);
    }
    
    /**
     * Set status as paid
     *
     */
    private function setAsPaid()
    {
        if(empty($this->reserved_at)) return;
        if(empty($this->afa_selected_at)) return;
        if(empty($this->tma_paid_at)) return;
        if(empty($this->afa_paid_at)) return;
        if(empty($this->apl_paid_at)) return;
        if(empty($this->confirmed_at)) return;
        if(!empty($this->cancelled_at)) return;
        
        $this->status = 'paid';
        $this->save();
        
        // Update product buyers
        if($this->product){
            $this->product->status = 'paid';
            $this->product->save();
        }
        
        $notification = new ShopOrderPaid($this);
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
        
        $notification = new ShopAfaSelected($this);
        $this->notify($notification);
    }
    
    /**
     * Paiement commission sur vente pour AFA par le seller
     *
     */
    public function setTmaPaid()
    {
        $this->tma_paid_at = \Carbon\Carbon::now();
        $this->save();
        
        $notification = new ShopTmaPaid($this);
        $this->notify($notification);
        
        $this->setAsPaid();
    }
    
    /**
     * Paiement Commission sur presentation de clientelle pour ADMIN par AFA
     *
     */
    public function setAfaPaid()
    {
        $this->afa_paid_at = \Carbon\Carbon::now();
        $this->save();
        
        $notification = new ShopAfaPaid($this);
        $this->notify($notification);
        
        $this->setAsPaid();
    }
    
    /**
     * Paiement Commission MIO pour APL par ADMIN
     *
     */
    public function setAplPaid()
    {
        $this->apl_paid_at = \Carbon\Carbon::now();
        $this->save();
        
        $notification = new ShopAplPaid($this);
        $this->notify($notification);
        
        $this->setAsPaid();
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
        
        $notification = new ShopOrderCancelled($this);
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
        
        $notification = new ShopOrderConfirmed($this);
        $this->notify($notification);
        
        $this->setAsPaid();
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
