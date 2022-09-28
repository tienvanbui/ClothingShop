<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CachedListingDisplayedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $table = null;
    public $showPerPage = null;
    public $page = null;
    public $searchKey = null;
    public $collum = null;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($table, $showPerPage, $page, $searchKey, $collum)
    {
        $this->table = $table;
        $this->showPerPage = $showPerPage;
        $this->page = $page;
        $this->searchKey = $searchKey;
        $this->collum = $collum;
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
