<?php

namespace App\Events;

use App\Models\Message as ModelsMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

   
    public function __construct(ModelsMessage $message)
    {
        $this->message = $message;
    }

   
    public function broadcastOn()
    {
        return new Channel( $this->message->conversation->channel_name);
    }

    public function broadcastWith()
{
    return [
        'message' => [
            'id' => $this->message->id,
            'content' => $this->message->message_content,
            'type' => $this->message->message_type,
            'time_ago' => $this->message->time_ago,

            'sender' => [
                'id' => $this->message->sender->id,
                'name' => $this->message->sender->name,
                'avatar' => $this->message->sender->avatar,
            ]
        ]
    ];
}

   

    // public function broadcatAs()
    // {
    //         return 'App\Events\message';
    // }
}
