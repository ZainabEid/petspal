<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SimpleUserResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            'id' =>  $this->account()->id,
            'name' => $this->account()->name,
            'avatar' => $this->account()->avatar,
        ];
        // return parent::toArray($request);
    }
}
