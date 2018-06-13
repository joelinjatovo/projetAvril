<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;

class NewMail extends Notification implements ShouldQueue
{
    use Queueable;

    private $mail;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'mail_id' => $this->mail->id,
                'sender_id' => $this->mail->sender->id,
                'sender_name' => $this->mail->sender->name,
                'message' => $this->mail->sender->name.' vous a envoyé un mail',
            ],
        ];
    }
    
}
