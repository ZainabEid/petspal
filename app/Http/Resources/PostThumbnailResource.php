<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostThumbnailResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
           'post_id' => $this->id,
           'post_first_image' => $this->first_media,
        ];
        // return parent::toArray($request);
    }
}
