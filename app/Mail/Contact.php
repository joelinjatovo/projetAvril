<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;
    
    private $args;
    private $files;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($args = [], $files = [])
    {
        $this->args = $args;
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $args = $this->args;
        $files = $this->files;
        
        /*
        * Create markdown message
        */
        $message = $this->markdown('email.contact');
        $message = $message->with('args', $args);
        
        foreach($files as $file){
            $message = $message->attach($file->getRealPath());
        }
        
        if(isset($args['email']) && isset($args['name'])){
            $message->from($args['email'], $args['name']);
        }
        
        if(isset($args['subject'])){
            $message->subject($args['subject']);
        }
        
        return $message;
    }
}
