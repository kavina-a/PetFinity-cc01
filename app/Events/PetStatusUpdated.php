<?php

namespace App\Events;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PetStatusUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function broadcastOn()
    {
        $userId = null;

        if (Auth::guard('petowner')->check()) {
            $userId = Auth::guard('petowner')->id();
        } elseif (Auth::guard('petboarder')->check()) {
            $userId = Auth::guard('petboarder')->id();
        } elseif (Auth::guard('pettrainer')->check()) {
            $userId = Auth::guard('pettrainer')->id();
        }
    
        return new PrivateChannel('pet-status.' . $userId);    }

    public function broadcastWith()
    {
        return ['status' => $this->status];
    }
}
