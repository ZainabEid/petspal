<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'author_name' => $this->author->name,
            'autthor_avatar' => $this->author->avatar,
            'comment_id' => (string)$this->id,
            'comment_body' => $this->body,
            'comment_time_ago' => $this->time_ago,
            'comment_likes' => $this->likes()->count(),
        ];
        // return parent::toArray($request);
    }
}
