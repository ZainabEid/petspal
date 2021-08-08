<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SimpleUserResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'avatar' => $this->account()->avatar,
            'name' => $this->account()->name,
        ];
        // return parent::toArray($request);
    }
}
