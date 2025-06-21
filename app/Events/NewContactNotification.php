<?php
namespace App\Events;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewContactNotification implements ShouldBroadcast
{
    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('admin.notifications');
    }
}
