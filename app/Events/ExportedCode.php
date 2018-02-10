<?php

namespace App\Events;

use App\ExportCode;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ExportedCode
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $export;
    public $filename;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ExportCode $exportCode, $filename)
    {
        $this->export = $exportCode;
        $this->filename = $filename;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('code-exported');
    }
}
