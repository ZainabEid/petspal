<?php
namespace App\Repositories\Roles\Contracts;

use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    public function __construct(Role $admin);
   
    public function allNames();
 
   

}