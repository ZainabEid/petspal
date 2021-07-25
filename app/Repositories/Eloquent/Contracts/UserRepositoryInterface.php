<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\User;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface UserRepositoryInterface extends EloquentInterface
{
    public function __construct(User $user);
    public function create(array $attributes);
   
}