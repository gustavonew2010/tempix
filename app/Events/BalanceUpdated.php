<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BalanceUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $balance;

    public function __construct($userId, $balance)
    {
        $this->userId = $userId;
        $this->balance = $balance;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('wallet.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'balance.updated';
    }
} 