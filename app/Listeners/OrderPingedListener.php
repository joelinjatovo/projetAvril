<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\OrderPinged;

class OrderPingedListener
{
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
     * @var App\Models\Order $order
     * User Object to handle
     */
    protected $order;
    
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
     * @param  OrderPinged  $event
     * @return void
     */
    public function handle(OrderPinged $event)
    {
        $this->order = $event->order();
        //$this->sendMail();
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
