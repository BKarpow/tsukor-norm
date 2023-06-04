<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $nameUser;
    public string $emailUser;
    public string $ipUser;
    public int $timeRegister;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $nameUser, string $emailUser)
    {
        $this->nameUser = $nameUser;
        $this->emailUser = $emailUser;
        $this->ipUser = '';
        $this->timeRegister = strtotime(now());
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
