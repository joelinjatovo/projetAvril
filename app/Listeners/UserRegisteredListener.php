<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class UserRegisteredListener implements ShouldQueue
{
    use InteractsWithQueue;
    
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'sqs';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'listeners';
    
    /**
     * @var App\Models\User $user
     * User Object to handle
     */
    protected $user;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $this->user = $event->user;
        $this->sendMail();
        
    }
    
    
    public function failed(OrderShipped $event, $exception)
    {
        //
    }
    
    public function sendMail(){
        $user = $this->user;
        $data = array('item'=>$user);
        Mail::send('mail.registration', $data, function($message) use($user) {
            $message->to($user->email, $user->name)
                    ->subject('Registration Notification')
                    ->from("joelinjatovo@gmail.com", 'joelinjatovo');
        });
    }
}
