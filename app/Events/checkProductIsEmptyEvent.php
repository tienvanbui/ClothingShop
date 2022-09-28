<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class checkProductIsEmptyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $productId = null;
    public $colorId = null;
    public $sizeId = null;
    public $buyQuanlities = null;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($product_id, $color_id, $size_id, $buy_quanlities)
    {
        $this->productId = $product_id;
        $this->colorId = $color_id;
        $this->sizeId = $size_id;
        $this->buyQuanlities = $buy_quanlities;
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
