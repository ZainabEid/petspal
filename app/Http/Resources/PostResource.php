<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
  
    public function toArray($request)
    {
        return [
            'post_id' => (string)$this->id,
            'author' => $this->author->name,
            'author_avatar' => $this->author->avatar,
            'body' => $this->body_with_linked_tags,
            'likes_count' =>  (string)$this->likes()->count(),
            'comment_count' =>  $this->comments()->count(),
            'media'=> $this->media,
            'comments' => $this->comments,
            'time_ago' => $this->time_ago,
        ];

        // return parent::toArray($request);
    }

}
