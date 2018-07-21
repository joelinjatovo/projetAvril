<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Order;
use App\Models\User;

class ShopAfaSelected extends Notification implements ShouldQueue
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
                $message = $message->subject('APL: Afa Selected')
                    ->line("Un client vient de selectionner l'agence francophone australienne qui va s'ocupper de sa commande.")
                    ->action('Voir la commande', route('apl.order.show', $order));
            break;
                
            case 'afa':
                $message = $message->subject('AFA: Afa Selected')
                    ->line("Un client vient de vous choisir d'etre son agence francophone australienne qui va s'ocupper de sa commande.")
                    ->action('Voir la commande', route('afa.order.show', $order));
            break;
                
            case 'member':
                $message = $message->subject('Member: Afa Selected')
                    ->line("Quelqu'un vient de selectionner une agence francophone australienne qui va s'ocupper d'une commande.")
                    ->line(sprintf('Price %s', $order->price))
                    ->line(sprintf('Reservation %s', $order->reservation))
                    ->action('Voir la commande', route('member.order.show', $order));
            break;
                
            case 'admin':
                $message = $message->subject('Admin: Afa Selected')
                    ->line("Un client vient de selectionner l'agence francophone australienne qui va s'ocupper de sa commande.")

                    ->line(sprintf('Customer %s', $order->author->name))
                    ->action('Voir le client', route('admin.user.show', $cart->author))

                    ->line(sprintf('AFA selected %s', $order->author->name))
                    ->action("Voir l'agence francophone australienne", route('admin.user.show', $order->author))

                    ->action('Voir la commande', route('admin.order.show', $order));
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
        
        switch($user->role){
            case 'admin':
            case 'seller':
            case 'apl':
                return [
                    'id' => $this->id,
                    'read_at' => null,
                    'data' => [
                        'order_id' => $order->id,
                        'author_id' => $order->author->id,
                        'author_name' => $order->author->name(),
                        'message' => "Un client vient de selectionner l'agence francophone australienne qui va s'ocupper de sa commande.",
                    ],
                ];
            case 'afa':
                return [
                    'id' => $this->id,
                    'read_at' => null,
                    'data' => [
                        'order_id' => $order->id,
                        'author_id' => $order->author->id,
                        'author_name' => $order->author->name(),
                        'message' => "Un client vient de vous choisir d'etre son agence francophone australienne qui va s'ocupper de sa commande.",
                    ],
                ];
            case 'member':
                return [
                    'id' => $this->id,
                    'read_at' => null,
                    'data' => [
                        'order_id' => $order->id,
                        'author_id' => $order->author->id,
                        'author_name' => $order->author->name(),
                        'message' => "Vous venez de selectionner une agence francophone australienne qui va s'ocupper d'une commande.",
                    ],
                ];
        }
        
        return [
            'id' => 0,
            'read_at' => null,
            'data' => [
                'order_id' => 0,
                'author_id' => 0,
                'author_name' => null,
                'message' => 'Commande',
            ],
        ];
    }
}
