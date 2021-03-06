<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClinicsCategoriesTableSeeder::class);
        $this->call(ClinicsTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        
        $this->call(PageTableSeeder::class);
        
        $this->call(PetsCategoriesTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        
    }
}
