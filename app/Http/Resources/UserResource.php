<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'account_name' => $this->account()->name,
            'account_avatar' => $this->account()->avatar,
            'following_count' => $this->following()->count(),
            'followers_count' => $this->followers()->count(),
            'posts_count' => $this->posts()->count(),
        ];
        // return parent::toArray($request);
    }
}
