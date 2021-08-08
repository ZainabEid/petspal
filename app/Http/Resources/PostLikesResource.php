<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostLikesResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'post_id' => $this->id,
            'likes_count' => $this->likes()->count()
        ];
        // return parent::toArray($request);
    }
}
