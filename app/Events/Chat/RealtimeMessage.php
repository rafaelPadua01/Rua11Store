<?php

namespace App\Events\Chat;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class RealtimeMessage implements ShouldBroadcast 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $message;
  #  public $user;
    
    public function __construct(Message $message)
    {
        $this->message = $message;
       # $this->user = $user;
       
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    
   
     public function broadcastOn()
    {
        return new Channel('messages');
    }

    public function broadcastAs()
    {
        return 'messages';
    }

    
    
}
