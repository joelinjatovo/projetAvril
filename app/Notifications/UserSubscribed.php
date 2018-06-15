<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserSubscribed extends Notification
{
    use Queueable;
    
    private $user;
    private $plan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Plan $plan)
    {
        $this->user = $user;
        $this->plan = $plan;
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
        
        /** @var mixed $plan */
        $plan = $this->plan;
        
        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('mail.subscribed.subject', ['app'=>app_name(), 'plan'=>$plan->name]))
            ->greeting(__('mail.greeting', ['name'=>$user->name]))
            ->line(__('mail.subscribed.content', ['count'=>$plan->getDayCount(), 'plan'=>$plan->name]))
            ->line(__('mail.thank'));
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
