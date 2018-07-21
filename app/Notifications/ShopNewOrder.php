<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Order;
use App\Models\User;

class ShopNewOrder extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    
    private $order;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Set user
     *
     * @param  \User|null $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return $this->user
     */
    public function getUser()
    {
        return $this->user;
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
                $message = $message->subject('APL: New Order')
                    ->line('Someone ordered product that you are the selected APL.')
                    ->action('View More', route('apl.order.show', $order));
            break;
                
            case 'afa':
                $message = $message->subject('AFA: New Order')
                    ->line('Someone ordered product that you are the selected AFA.')
                    ->action('View More', route('afa.order.show', $order));
            break;
                
            case 'member':
                $message = $message->subject('Member: NewOrder')
                    ->line('Someone ordered product for an account with this email address.')

                    ->line(sprintf('Price %s', $order->price))
                    ->line(sprintf('Reservation %s', $order->reservation))
                    ->action('View More', route('member.order.show', $order));
            break;
                
            case 'admin':
                $message = $message->subject('Admin: New Order')
                    ->line('A customer ordered product')

                    ->line(sprintf('Customer %s', $order->author->name))
                    ->action('View Customer', route('admin.user.show', $order->author))

                    ->line(sprintf('Amount %s', $order->price))
                    ->line(sprintf('Reservation %s', $order->reservation))
                    ->line(sprintf('Commission sur vente %s', $order->tma))
                    ->line(sprintf('Commission sur presentation de la clientelle %s', $order->afa_amount))
                    ->line(sprintf('Commission MIO %s', $order->apl_amount))
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
        /** @var User $user */
        $user = $this->user;
        
        /** @var mixed $order */
        $order = $this->order;
        
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'order_id' => $order->id,
                'author_id' => $order->author->id,
                'author_name' => $order->author->name,
                'message' => 'Une commande a été effectuée par '.ucfirst($order->author->name())
            ],
        ];
    }
}
