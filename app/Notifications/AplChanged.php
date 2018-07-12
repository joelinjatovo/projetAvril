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

    private $user;
    private $isApl;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $isApl = false)
    {
        $this->user = $user;
        $this->isApl = $isApl;
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
        if(!$this->isApl){
            // Notify USER
            return (new MailMessage)
                    ->from(env('ADMIN_MAIL'))
                    ->subject('APL Changed')
                    ->greeting(sprintf('Hello %s', $user->name))
                    ->line('You have changed your APL.')
                    ->action('View More', route('home'))
                    ->line('Thank you for using our application!');
        }
        // Notify APL
        return (new MailMessage)
                ->from(env('ADMIN_MAIL'))
                ->subject('Selected as APL')
                ->greeting(sprintf('Hello %s', $user->name))
                ->line('Someone have selected your account as APL.')
                ->action('View More', route('home'))
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
