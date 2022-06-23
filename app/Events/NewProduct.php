<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewProduct implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $storName;
    public $id;
    public $name;
    public $small_description;
    public $description;
    public $orginal_price;
    public $selling_price;
    public $img;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($storName,$name,$small_description, $description,$orginal_price,$selling_price,$img)
    {
    $this->storName=$storName;
    $this->name=$name;
    $this->small_description=$small_description;
    $this->description=$description;
    $this->orginal_price=$orginal_price;
    $this->selling_price=$selling_price;
    $this->img=$img;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-one');
    }

    public function broadcastWith()
    {
        return [
            'storName' => $this->storName,
            'name' => $this->name,
            'small_description' => $this->small_description,
            'description' => $this->description,
            'orginal_price' => $this->orginal_price,
            'selling_price' => $this->selling_price,
            'img' => $this->img,

        ];
    }
}
