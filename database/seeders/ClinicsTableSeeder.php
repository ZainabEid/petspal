<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\WorkingDay;
use App\Models\WorkingHour;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicsTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Clinic::truncate();
        WorkingDay::truncate();
        WorkingHour::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $clinics =[
            0=>[
                'clinic'=>[
                    'clinics_categrory_id' =>2,
                    'name' =>  ['en' =>'PetClinic', 'ar' => 'PetClinicAr'],
                    'description' =>  ['en' => 'Clinic For All Kind of Pets', 'ar' => 'Clinic For All Kind of Pets Ar'],
                    'address' => 'Mansoura,DK',
                    'social' => json_encode(['facebook'=>'facebook link','twitter'=>'twitter link','instagram'=>'instagram link']),
                    
                    'rate' => 4.5 ,
                ],
                'workingDays'=>[
                    'sunday'     =>  [
                        ['open_at'=>'8:00','close_at'=>'12:00'],
                        ['open_at'=>'13:00','close_at'=>'17:00'],
                        ['open_at'=>'18:00','close_at'=>'22:00'],
                    ],
                    
                    'monday'     =>[
                        ['open_at'=>'8:00','close_at'=>'12:00'],
                        ['open_at'=>'13:00','close_at'=>'17:00'],
                        ['open_at'=>'18:00','close_at'=>'22:00'],
                        ],
                    'tuseday'     => [
                        ['open_at'=>'8:00','close_at'=>'12:00'],
                        ['open_at'=>'13:00','close_at'=>'17:00'],
                        ['open_at'=>'18:00','close_at'=>'22:00'],
                        
                    ],
                    'wednesday'     =>  [
                        ['open_at'=>'8:00','close_at'=>'12:00'],
                        ['open_at'=>'13:00','close_at'=>'17:00'],
                        ['open_at'=>'18:00','close_at'=>'22:00'],
                        
                    ],
                ],


            ]
        ];

        foreach ($clinics as $i => $clinic) {
            $clinic = Clinic::create($clinic['clinic']);

            foreach ($clinic['workingDays'] as $day => $periods) {
                $working_day = $clinic->workingDays()->create(['day' => $day]);
                $working_day->periods()->createMany($periods);
            }
            
        }


        

      

      
       
    }
}
