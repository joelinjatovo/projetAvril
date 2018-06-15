<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountCreated extends Notification
{
    use Queueable;
    
    private $user;
    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user , $password)
    {
        $this->user = $user;
        $this->password = $password;
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
        
        /** @var mixed $password */
        $password = $this->password;
        
        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject(__('mail.created.subject', ['app'=>app_name()]))
            ->greeting(__('mail.greeting', ['name'=>$user->name]))
            ->subject(__('mail.created.content.1'))
            ->subject(__('mail.created.content.2'))
            ->action(__('mail.btn.active'), route('activate.user', $user->activation_code))
            ->line(__('mail.default_password', ['password'=>$password]))
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
