<?php

namespace App\Events\Chat;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $userNotification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $message, int $userNotification)
    {
        $this->message = $message;
        $this->userNotification = $userNotification;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->userNotification);
    }

    public function broadcastAs()
    {
        return 'sendMessage';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }
}
