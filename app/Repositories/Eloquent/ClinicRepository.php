<?php
namespace App\Repositories\Eloquent;

use App\Models\Clinic;
use App\Repositories\Eloquent\Contracts\ClinicInterface;
use Illuminate\Support\Facades\DB;

class ClinicRepository extends BaseRepository implements ClinicInterface
{
    protected $model;

    public function __construct(Clinic $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

    public function create(array $attributes)
    {


        DB::beginTransaction();

        try {
           
            // create clinic model
            $model = $this->model->create( [

                'clinics_categrory_id' => $attributes['category_id'],
                'name' =>  ['en' => $attributes['name'][0], 'ar' => $attributes['name'][1]],
                'description' =>  ['en' => $attributes['description'][0], 'ar' => $attributes['description'][1]],
                'address' => $attributes['address'],
                'social' => json_encode($attributes['social']),
                
                'rate' => 4.5 ,
    
            ]);

            // assign phones
            foreach ($attributes['phones']  as $index => $phone) {
               
                $model->phones()->create(['phone' => $phone]);

            } // end foreach

            // assign working hours
            if(isset($attributes['workDays'])){

                foreach( $attributes['workDays'] as $day => $periods ){
    
                    $working_day = $model->workingDays()->create(['day'=> $day]);
    
                    $working_day->periods()->createMany($periods);
                }
            }

            
            // assign off days
            if(isset($attributes['off_days'])){

                foreach( $attributes['off_days'] as $off_day ){
    
                    $model->offDays()->create([
                        'title'=> $off_day['title'],
                        'date'=>  $off_day['date'],
                    ]);
    
                    
                }
            }
            
            // assign gallery
            //
            // if no  photo
            if(! isset($attributes['medias'])) {

                $model->gallery()->create([
                    'src'=> 'default.png',
                    'type'=> 'gallery'
                ]);

            }else{
            // if photo
                
                foreach ($attributes['medias'] as $key => $photo) {
    
                   $image =  save_image('clinics', $photo);
    

                   // store in db if stored in disk
                   if ($image) {

                       $model->gallery()->create([
                           'src'=> $photo->hashName(),
                           'type'=> 'gallery'
                       ]);
                   }
                } 
            }

        } catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }
        
       
        DB::commit();

        return $model->fresh();
    }


    public function update(int $clinicId = null, array $attributes)
    {
        DB::beginTransaction();

        // dd( $attributes);
        try {
            $clinicId  = ($clinicId  == null ) ? $this->model->id : $clinicId ;

            $clinic = $this->findById($clinicId);

           
            // update clinic model
            $clinic->update( [

                'clinics_categrory_id' => $attributes['category_id'],
                'name' =>  ['en' => $attributes['name'][0], 'ar' => $attributes['name'][1]],
                'description' =>  ['en' => $attributes['description'][0], 'ar' => $attributes['description'][1]],
                'address' => $attributes['address'],
                'social' => json_encode($attributes['social']),
                
                'rate' => 4.5 ,
    
            ]);

          

            // update phones
            if(isset($attributes['phones'])){

                $clinic->phones()->delete();
                foreach ($attributes['phones']  as $index => $phone) {
                   
                    $clinic->phones()->create(['phone' => $phone]);
    
                } // end foreach
            }

            // assign working hours
            if(isset($attributes['workDays'])){

                $clinic->workingDays()->delete();
                foreach( $attributes['workDays'] as $day => $periods ){
                    
                    $working_day = $clinic->workingDays()->create(['day'=> $day]);
    
                    $working_day->periods()->createMany($periods);
                }
            }

            
            // assign off days
            if(isset($attributes['off_days'])){

                $clinic->offDays()->delete();
                foreach( $attributes['off_days'] as $off_day ){
    
                    $clinic->offDays()->create([
                        'title'=> $off_day['title'],
                        'date'=>  $off_day['date'],
                    ]);
    
                    
                }
            }
            
            
            // assign gallery
            if( isset($attributes['medias'])) {

                // 1.remove default if 
                if( $clinic->gallery()->first()->src == 'default.png' ){
                    $clinic->gallery()->first()->delete();
                }

                // 2. add new medias
                foreach ($attributes['medias'] as $key => $photo) {
    
                   $image =  save_image('clinics', $photo);
    

                   // store in db if stored in disk
                   if ($image) {

                       $clinic->gallery()->create([
                           'src'=> $photo->hashName(),
                           'type'=> 'gallery'
                       ]);
                   }
                } 

            }

        } catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }
        
       
        DB::commit();

        return $clinic;
    }

}
