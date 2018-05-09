<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ThreadCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $thread;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];

        if ($this->thread->userone) {
            array_push($channels, new PrivateChannel('users.' . $this->thread->userone->id));
        }

        if ($this->thread->usertwo) {
            array_push($channels, new PrivateChannel('users.' . $this->thread->usertwo->id));
        }

        return $channels;
    }
}
