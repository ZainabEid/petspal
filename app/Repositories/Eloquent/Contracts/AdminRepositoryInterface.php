<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\Admin;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface AdminRepositoryInterface extends EloquentInterface
{
    public function __construct(Admin $admin);
    public function create(array $attributes ,  array $roles = []);
    public function update(int $modelId , array $attributes, array $roles =[]);
   

}