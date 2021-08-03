<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    
    public function toArray($request)
    {
        if($this->is_adoption){
            return [
                'name' => $this->name,
                'email' => $this->email,
                'type' => $this->type,
                'category' => $this->category,
                'user' => $this->user,
                'accounts' => $this->user->accounts,
                'gallery' => $this->gallery,
            ];
        }

        $posts = isset($this->user->posts) ? $this->user->posts()->paginate(5): null;

        return [
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'category' => $this->category->name,
            'user' => $this->user,
            'accounts' => $this->user->accounts,
            'followers' => $this->user->followers,
            'following' => $this->user->following,
            'posts' =>  $posts,
        ];

        // return parent::toArray($request);
    }
}
