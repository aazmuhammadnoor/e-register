<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BroadcastSMS
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $permohonan;
    public $jenis;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($permohonan, $jenis)
    {
        $this->permohonan = $permohonan;
        $this->jenis = $jenis;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
