<?php
namespace App\Repositories\Roles;

use App\Repositories\Roles\Contracts\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    protected $model ;

    public function __construct(Role $role)
    {
        $this->model =  $role;   
    }


    public function allNames(){

        $all_roles = Role::all()->pluck('name');

        // convert simple array to associative array.
        $roles = [];

        foreach($all_roles as $role){

            $roles += [$role => $role];
        }
        return $roles;
    }

}

