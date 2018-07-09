<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Order;
use App\Models\User;

class AfaSelected extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $order;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /** @var User $user */
        $user = $this->user;
        
        /** @var mixed $order */
        $order = $this->order;
        
        /** @var MailMessage $message */
        $message = (new MailMessage)->greeting(sprintf('Hello %s', $user->name));
        
        switch($user->role){
            case 'apl':
                $message = $message->subject('APL: Afa Selected')
                    ->line('Someone ordered product that you are the selected APL.')
                    ->action('View More', route('apl.order.show', $order));
            break;
                
            case 'afa':
                $message = $message->subject('AFA: Afa Selected')
                    ->line('Someone ordered product that you are the selected AFA.')
                    ->action('View More', route('afa.order.show', $order));
            break;
                
            case 'member':
                $message = $message->subject('Member: Afa Selected')
                    ->line('Someone ordered product for an account with this email address.')

                    ->line(sprintf('Price %s', $order->price))
                    ->line(sprintf('Reservation %s', $order->reservation))
                    ->action('View More', route('afa.order.show', $order));
            break;
                
            case 'admin':
                $message = $message->subject('Admin: Afa Selected')
                    ->line('A customer ordered product')

                    ->line(sprintf('Customer %s', $cart->author->name))
                    ->action('View Customer', route('admin.user.show', $cart->author))

                    ->line(sprintf('Quantity %s', $cart->totalQuantity))
                    ->line(sprintf('Amount %s', $cart->totalPrice))
                    ->line(sprintf('TMA %s', $cart->totalTma))
                    ->action('View More', route('admin.order.show', $order));
            break;
        }
        
        return $message->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        switch($user->role){
            case 'apl':
                return [
                    'id' => $this->id,
                    'read_at' => null,
                    'data' => [
                        'cartitem_id' => $this->cartitem->id,
                        'author_id' => $this->cartitem->author->id,
                        'author_name' => $this->cartitem->author->name,
                        'message' => 'Commission MIO payée',
                    ],
                ];
            case 'afa':
                return [
                    'id' => $this->id,
                    'read_at' => null,
                    'data' => [
                        'cartitem_id' => $this->cartitem->id,
                        'author_id' => $this->cartitem->author->id,
                        'author_name' => $this->cartitem->author->name,
                        'message' => 'Commission MIO payée',
                    ],
                ];
            case 'seller':
                return [
                    'id' => $this->id,
                    'read_at' => null,
                    'data' => [
                        'cartitem_id' => $this->cartitem->id,
                        'author_id' => $this->cartitem->author->id,
                        'author_name' => $this->cartitem->author->name,
                        'message' => 'Commissions MIO payées',
                    ],
                ];
            case 'admin':
                return [
                    'id' => $this->id,
                    'read_at' => null,
                    'data' => [
                        'cart_id' => $this->cart->id,
                        'author_id' => $this->cart->author->id,
                        'author_name' => $this->cart->author->name,
                        'message' => 'Commissions MIO payées',
                    ],
                ];
            case 'member':
                return [
                    'id' => $this->id,
                    'read_at' => null,
                    'data' => [
                        'cart_id' => $this->cart->id,
                        'author_id' => $this->cart->author->id,
                        'author_name' => $this->cart->author->name,
                        'message' => 'Commissions MIO payées',
                    ],
                ];
        }
        
        return [
            'id' => 0,
            'read_at' => null,
            'data' => [
                'cart_id' => 0,
                'author_id' => 0,
                'author_name' => null,
                'message' => 'Commande',
            ],
        ];
    }
}
