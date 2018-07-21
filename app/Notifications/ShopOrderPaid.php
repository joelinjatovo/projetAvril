<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Order;
use App\Models\User;

class ShopOrderPaid extends Notification implements ShouldQueue
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
                $message = $message->subject('APL: Achat terminé')
                    ->line("L'achat suivant a été terminé.")
                    ->action("Voir l'achat", route('apl.order.show', $order));
            break;
                
            case 'afa':
                $message = $message->subject('AFA: Achat terminé')
                    ->line("L'achat suivant a été terminé.")
                    ->action("Voir l'achat", route('afa.order.show', $order));
            break;
                
            case 'member':
                $message = $message->subject('Member: Achat terminé')
                    ->line("L'achat suivant a été terminé.")
                    ->action("Voir l'achat", route('member.order.show', $order));
            break;
                
            case 'admin':
                $message = $message->subject('Admin: Achat terminé')
                    ->line("L'achat suivant a été terminé.")
                    ->action("Voir l'achat", route('admin.order.show', $order));
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
                'message' => "L'achat suivant a été terminé."
            ],
        ];
    }
}
