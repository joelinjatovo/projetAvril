<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\User;

class AplChanged extends Notification
{
    use Queueable;

    private $user1;
    
    private $user2;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user1, User $user2)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
    }

    /**
     * Set user
     *
     * @param  \User|null $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user1 = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return $this->user
     */
    public function getUser()
    {
        return $this->user1;
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
        $user1 = $this->user1;
        $user2 = $this->user2;
        
        if($user1->hasRole('member')){
            // Notify USER
            return (new MailMessage)
                    ->subject('Agence Partenaire Locale modifié')
                    ->greeting(sprintf('Bonjour %s', $user1->name))
                    ->line('Vous venez de selectionner une nouvelle agence partenaire locale.')
                    ->action("Contactez l'agence", route('member.contact'))
                    ->line("Merci d'avoir utilisé notre application.");
        }
        // Notify APL
        return (new MailMessage)
                ->subject('Nouveau client')
                ->greeting(sprintf('Bonjour %s', $user1->name))
                ->line("Vous etes choisi par un client en tant que son agence partenaire locale.")
                ->action('Contactez le client', route('apl.user.contact', $user2))
                ->line("Merci d'avoir utilisé notre application.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if(!$this->isApl){
            // Notify USER
            return [
                'id' => $this->id,
                'read_at' => null,
                'data' => [
                    'is_apl' => $this->isApl,
                    'user_id' => $this->user->apl->id,
                    'user_name' => $this->user->apl->name,
                    'message' => 'Vous avez changé votre APL.',
                ],
            ];
        }
        
        // Notify APL
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'is_apl' => $this->isApl,
                'user_id' => $this->user->id,
                'user_name' => $this->user->name,
                'message' => $this->user->name . ' vous a selectionné comme APL.',
            ],
        ];
    }
}
