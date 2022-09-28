<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class contactMessageSubmit
{
    use Dispatchable, SerializesModels;

    public $message = null;
    public $fromEmail = null;
    public $toMail = null;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $fromEmail, $toMail)
    {
        $this->message = $message;
        $this->fromEmail = $fromEmail;
        $this->toMail = $toMail;
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
