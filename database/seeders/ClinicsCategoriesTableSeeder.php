<?php

namespace Database\Seeders;

use App\Models\ClinicsCategory;
use Illuminate\Database\Seeder;

class ClinicsCategoriesTableSeeder extends Seeder
{
  
    public function run()
    {
         $category = ClinicsCategory::create([
            'name' =>  ['en' => 'category name 1', 'ar' => 'category name 1'],
            'description' =>  ['en' => 'category description 1', 'ar' => 'category description 1'],
            ]);
        $category2 = ClinicsCategory::create([
            'name' =>  ['en' => 'category name 2', 'ar' => 'category name 2'],
            'description' =>  ['en' => 'category description 2', 'ar' => 'category description 2'],
            ]);
        $category2 = ClinicsCategory::create([
            'name' =>  ['en' => 'category name 3', 'ar' => 'category name 3'],
            'description' =>  ['en' => 'category description 3', 'ar' => 'category description 3'],
            ]);
        $category = ClinicsCategory::create([
            'name' =>  ['en' => 'category name 4', 'ar' => 'category name 4'],
            'description' =>  ['en' => 'category description 4', 'ar' => 'category description 4'],
            ]);
    }
}
