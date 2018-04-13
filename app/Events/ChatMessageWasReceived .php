<?php

namespace App\Events;
class ChatMessageWasReceived implements ShouldBroadcast  
{
    use InteractsWithSockets, SerializesModels;

    public $chatMessage;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param $chatMessage
     * @param $user
     */
    public function __construct($chatMessage, $user)
    {
        $this->chatMessage = $chatMessage;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('public-test-channel');
    }
}


