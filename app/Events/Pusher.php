<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Pusher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $channel, $event, $data;

    /**
     * PusherEvent constructor.
     * @param string $channel
     * @param string $event
     * @param array $data
     */
    public function __construct($channel, $event, $data = [])
    {
        $this->channel = $channel;
        $this->event = $event;
        $this->data = $data;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['my-channel'];
    }
}
