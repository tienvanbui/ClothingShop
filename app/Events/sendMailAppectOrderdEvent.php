<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class sendMailAppectOrderdEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_name = '';
    public $user_email = '';
    public $products = [];
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_name, $user_email, $products)
    {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->products = $products;
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
