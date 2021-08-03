<?php
namespace App\Repositories\Eloquent;

use App\Models\Clinic;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\ClinicInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Optix\Media\MediaUploader;

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
            
            // create clinic record
            $model = $this->model->create( [
                'clinics_category_id' => $attributes['category_id'],
                'name' =>  ['en' => $attributes['name'][0], 'ar' => $attributes['name'][1]],
                'description' =>  ['en' => $attributes['description'][0], 'ar' => $attributes['description'][1]],
                'address' => $attributes['address'],
                'social' => json_encode($attributes['social']),
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

            dd($attributes['medias']);

            
            // assign gallery
            //
            // if photo
            if( isset($attributes['medias'])) {
                
                foreach ($attributes['medias'] as $key => $photo) {

                    // create & store image
                    $media = MediaUploader::fromFile( $photo)
                    ->useFileName($model->name.'-gallery-'.$key.'.'.$photo->extension())
                    ->useName($model->name.'-gallery-'.$key)
                    ->upload();

                       //attatch to account
                    $model->attachMedia($media, 'gallery');
    
                  
                } 
            }

        } catch(\Exception $e)
        {
            DB::rollback();
            throw new Exception($e->getMessage());

            return back()->withError($e->getMessage());
        }
        
       
        DB::commit();

        return $model->fresh();
    }

    public function updateAvatar(Clinic $clinic, $image)
    {
        DB::beginTransaction();


        try {
        
            if( $clinic->getFirstMedia('avatar')){
              
                $clinic->getFirstMedia('avatar')->delete();
            }


            // create & store image
            $media = MediaUploader::fromFile( $image)
                ->useFileName($clinic->name.'-avatar.'.$image->extension())
                ->useName($clinic->name.'-avatar')
                ->upload();

        
            //attatch to clinic
            $clinic->attachMedia($media, 'avatar');

        } catch(\Exception $e){

            DB::rollback();
            return back()->withError($e->getMessage());
        }

        
        DB::commit();
        return $clinic;
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

                foreach ($attributes['medias'] as $key => $photo) {
    
                    // create & store image
                    $media = MediaUploader::fromFile( $photo)
                        ->useFileName($clinic->name.'-gallery-'.$key.'.'.$photo->extension())
                        ->useName($clinic->name.'-gallery-'.$key)
                        ->upload();

                    //attatch to account
                    $clinic->attachMedia($media, 'gallery');
                  
                } 

            }

        } catch(\Exception $e)
        {
            DB::rollback();
            return back()->withError($e->getMessage());
        }
        
       
        DB::commit();

        return $clinic;
    }

    public function rate(Clinic $clinic , int $rate ,int $user_id)
    { 
        // update clinic model
        $clinic->rates()->updateOrCreate(
            ['user_id' => $user_id],
            ['rate' => $rate]);
        
        return $clinic;
    }

}
