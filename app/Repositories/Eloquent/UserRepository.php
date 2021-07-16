<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\Contracts\AdminRepositoryInterface;

class UserRepository extends BaseRepository implements AdminRepositoryInterface
{
    protected $model ;

    public function __construct(User $user)
    {
        $this->model =  $user;   
    }
}

