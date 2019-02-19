<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessageUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $auth;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $auth, $message)
    {
        $this->user    = $user;
        $this->auth    = $auth;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
