<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface TagInterface
{
    public function __construct(Post $admin);
   
   

}