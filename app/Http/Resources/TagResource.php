<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'tag_name'=>$this->tag_name,
            'posts_count'=>$this->posts->count(),
        ];
        // return parent::toArray($request);
    }
}
