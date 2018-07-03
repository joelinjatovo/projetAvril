<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Mailable
{
    use Queueable, SerializesModels;
    
    private $email;
    private $files;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Mail $email, $files = [])
    {
        $this->email = $email;
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->markdown('email.markdown');
        $message = $message->with('item', $this->email);
        $message = $message->with('url', route('home'));
        foreach($this->files as $file){
            $message = $message->attach($file->getRealPath());
        }
        return $message;
    }
}
