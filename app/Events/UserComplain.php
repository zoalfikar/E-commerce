<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserComplain
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $complain;
    public $prod_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($complain,$prod_id)
    {
        $this->complain=$complain;
        $this->prod_id=$prod_id;
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
