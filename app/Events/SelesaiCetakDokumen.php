<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SelesaiCetakDokumen
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $permohonan;
    public $files_permohonan;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($file, $permohonan)
    {
        $this->permohonan = $permohonan;
        $this->files_permohonan = $file;
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
