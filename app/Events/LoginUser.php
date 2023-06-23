<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $ip;
    public string $ua;
    public User $user;
    public bool $isSocLogin;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $ip, string $ua, User $user, bool $isSocLogin = false)
    {
        $this->ip = $ip;
        $this->ua = $ua;
        $this->user = $user;
        $this->isSocLogin =$isSocLogin;
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
