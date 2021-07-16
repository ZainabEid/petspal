<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
   
    public function run()
    {
        // Super_Admin
        $super_admin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@petspals.com',
            'password' => bcrypt('qwertyuiop'),
        ]);
        
        $super_admin->assignRole('super_admin');

    }
}
