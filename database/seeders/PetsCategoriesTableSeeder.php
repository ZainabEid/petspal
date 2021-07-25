<?php

namespace Database\Seeders;

use App\Models\PetsCategory;
use Illuminate\Database\Seeder;

class PetsCategoriesTableSeeder extends Seeder
{
   
    public function run()
    {
        $categories =[
          1 =>  [
            'name' =>  ['en' => 'Cat', 'ar' => 'قطة'],
            'description' =>  ['en' => 'cats', 'ar' => 'قطط'],
          ],
          2=>[
            'name' =>  ['en' => 'Dog', 'ar' => 'كلب'],
            'description' =>  ['en' => 'Dogs', 'ar' => 'كلاب'],
          ],
          3=>[
            'name' =>  ['en' => 'Hamester', 'ar' => 'هامستر'],
            'description' =>  ['en' => 'Hamesters', 'ar' => 'هامستر'],
          ],
        
        ];

        foreach ($categories as  $category) {
          PetsCategory::create($category);
        }

    } // end of run
}
