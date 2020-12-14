<?php

namespace App\Events;

use App\Http\Controllers\NotificationController;
use App\Models\Notifications;
use App\Models\Order;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Console\Commands\NotificationTraits;

class OrderReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $targetId;    
    public $createdAt;

    public function __construct(Order $order)
    {                       
        $this->message = "{$order->user->name} just placed an order.";
        $this->targetId = $order->id;        
        
        $newNotification = new Notifications([
            'target_id' => $this->targetId,
            'message' => $this->message,
            'type' => "ORDER",
        ]);

        $newNotification->save();

        $this->createdAt = $newNotification->created_at;
    }
  
    public function broadcastOn()
    {
        return ['notifications'];
    }
  
    public function broadcastAs()
    {
        return 'notification-event';
    }
}
