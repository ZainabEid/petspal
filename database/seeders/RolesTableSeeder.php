<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
   
    public function run()
    {

        
        // setting roles
        $roles = [
            'admins',
            'super_admin'
        ];
        

        // admins role
        foreach ($roles as  $role) {
            Role::create(['guard_name' => 'admin', 'name' => $role]);
        }

        // // super admin role : attach all permissions to the admin
        // Role::create(['guard_name' => 'admin', 'name' => 'super_admin'])
        //     ->syncPermissions(Permission::all());
    }
}
