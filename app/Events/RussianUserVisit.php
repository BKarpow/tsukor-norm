<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RussianUserVisit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $ip;
    public string $userAgent;
    public int $timeVisit;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $ip, string $userAgent, int $timeVisit)
    {
        $this->ip = $ip;
        $this->userAgent = $userAgent;
        $this->timeVisit = $timeVisit;
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
