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
            ->from(env('ADMIN_MAIL', 'tsorakoto@gmail.com'))
            //->to($user->email, $user->name)
            ->subject('Successfully created new account')
            ->greeting(sprintf('Hello %s', $user->name))
            ->line('You have successfully registered to our system. Please activate your account.')
            ->action('Active Account', route('activate.user', $user->activation_code))
            ->line(sprintf('Your default password is %s', $password))
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
