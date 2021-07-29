<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
  
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // setting general permition for each model
        $models = getModel();

        // $models = ['admin','user','account','clinic','post'];
        $maps = ['create', 'read', 'update', 'delete'];

        $arrayOfPermissionNames = []; // ['create_categories' , 'create_admins',...]

        foreach ($models as $model) {
            
            foreach ($maps as $map) {
                $arrayOfPermissionNames[] = $map . '_' . $model;
            }
        }

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'admin'];
        });

        Permission::insert($permissions->toArray());
    }


    
}
