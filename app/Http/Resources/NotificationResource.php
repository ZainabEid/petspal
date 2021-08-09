<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_name' => $this->data['user_name'],
            'user_id' => $this->data['user_id'],
            'avatar' => $this->data['user_avatar'],
            'title' => $this->type,
            // 'title' => $this->data['title'],
            // 'body' => $this->data['body'],
            'time_ago'=>str_ireplace(
                [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'], 
                ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'], 
                $this->created_at->diffForHumans()),
            'is_read' => $this->read_at ?true: false
        ];
    }
}
