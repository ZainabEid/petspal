<?php

namespace Database\Seeders;

use App\Models\ClinicsCategory;
use Illuminate\Database\Seeder;

class ClinicsCategoriesTableSeeder extends Seeder
{
  
    public function run()
    {
        $categories =[
          1 =>  [
                'name' =>  ['en' => 'surgery', 'ar' => 'جراحة'],
                'description' =>  ['en' => 'sergery', 'ar' => 'جراحة'],
          ],
          2=>[
            'name' =>  ['en' => 'Critical Care', 'ar' => 'عناية متخصصة'],
            'description' =>  ['en' => 'Critical Care', 'ar' => 'عناية متخصصة'],
          ],
          3=>[
            'name' =>  ['en' => 'Specialists', 'ar' => 'أخصائي'],
            'description' =>  ['en' => 'Specialists', 'ar' => 'أخصائي'],
          ],
        

        ];

        foreach ($categories as  $category) {
           ClinicsCategory::create($category);
        }
        
      
    }
}
