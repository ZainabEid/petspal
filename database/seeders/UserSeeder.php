<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\PetsCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   
    public function run()
    {
       $users = User::factory(20)->create();
       foreach ($users as $user) {
            $user->accounts()->create([
                'name' => $user->name, 
                'email' => $user->email, 
                'pets_category_id' => PetsCategory::all()->random()->id, 
                'is_adoption' => rand(1,2), 
           ]);
       }
    }
}
