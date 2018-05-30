<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;

class OrderPaid extends Notification
{
    use Queueable;

    
    private $user;
    private $cart;
    private $cartItem;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Cart $cart, CartItem $cartItem)
    {
        $this->user = $user;
        $this->cart = $cart;
        $this->cartItem = $cartItem;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
        
        /** @var mixed $cart */
        $cart = $this->cart;
        
        /** @var mixed $cartItem */
        $cartItem = $this->cartItem;
        
        switch($user->role){
            case 'apl':
                return (new MailMessage)
                    ->from(env('ADMIN_MAIL'))
                    ->subject('Order paid that you are the selected APL')
                    ->greeting(sprintf('Hello %s', $user->name))
                    ->line('Someone ordered product that you are the selected APL.')
                    ->action('View More', route('apl.cartitem.show', $cartItem))
                    ->line('Thank you for using our application!');
            case 'afa':
                return (new MailMessage)
                    ->from(env('ADMIN_MAIL'))
                    ->subject('Order paid that you are the selected AFA')
                    ->greeting(sprintf('Hello %s', $user->name))
                    ->line('Someone ordered product that you are the selected AFA.')
                    ->action('View More', route('afa.cartitem.show', $cartItem))
                    ->line('Thank you for using our application!');
            case 'member':
                return (new MailMessage)
                    ->from(env('ADMIN_MAIL'))
                    ->subject('Order paid')
                    ->greeting(sprintf('Hello %s', $user->name))
                    ->line('Someone ordered product for an account with this email address.')
                    ->action('View More', route('member.cart', $cart))
                    ->line('Thank you for using our application!');
            case 'admin':
                return (new MailMessage)
                    ->from(env('ADMIN_MAIL'))
                    ->subject('Order paid')
                    ->greeting(sprintf('Hello %s', $user->name))
                    ->line('A customer ordered product')
                    
                    ->line(sprintf('Customer %s', $cartItem->author->name))
                    ->action('View Customer', route('admin.user.show', $cartItem->author))
                    
                    ->line(sprintf('APL %s', $cartItem->apl->name))
                    ->action('View APL', route('admin.user.show', $cartItem->apl))
                    
                    ->line(sprintf('AFA %s', $cartItem->apl->name))
                    ->action('View AFA', route('admin.user.show', $cartItem->afa))
                    
                    ->action('View More', route('admin.cartitem.show', $cartItem))
                    ->line('Thank you for using our application!');
        }
        
        return (new MailMessage)
                    ->from(env('ADMIN_MAIL'))
                    ->subject('Hello with Order paid')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
