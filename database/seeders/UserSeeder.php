<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\PetsCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
   
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('accounts')->truncate();
        DB::table('followers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

       $users = User::factory(20)->create();

       foreach ($users as $user) {
            $user->accounts()->create([
                'name' => $user->name, 
                'email' => $user->email, 
                'pets_category_id' => PetsCategory::all()->random()->id, 
                'is_adoption' => rand(0,1), 
           ]);

           $user->followers()->attach(User::all()->random()->id);
       }
    }
}
