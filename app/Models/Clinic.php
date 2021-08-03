<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Optix\Media\HasMedia;
use Spatie\Translatable\HasTranslations;

class Clinic extends Model
{
    use HasFactory,SoftDeletes;
    use HasTranslations , HasMedia;
    

    public $translatable = ['name', 'description'];

    protected $fillable =[
        'name', 'description' , 'clinics_category_id' , 'address' ,'social', 'working_hours' , 'contacts' 
    ];

    protected $appends=[
        'facebook', 'twitter','instagram' , 'rate'
    ];

    protected $cast =[
        'rate' => 'float'
    ];


    ###### gettin attributes ######

    public function getRateAttribute()
    {
    //    $rate = $this->rates()->avg('rate');
       $rate = $this->rates()->select(DB::raw('SUM(rate)/COUNT(user_id)  AS rate'))->first();
      return number_format($rate->rate, 1);
    }

    public function getFacebookAttribute()
    {
        return json_decode($this->social)->facebook;
        
    }

    public function getTwitterAttribute()
    {
        
        return json_decode($this->social)->twitter;
    }

    public function getInstagramAttribute()
    {
        return json_decode($this->social)->instagram;
    }


    ###### Functions #####


    // get all media
    public function gallery()
    {
      
        if ( $this->getMedia('gallery') ) {
           
            return $this->getMedia('gallery');
        }

        return asset('/default.png');
    }

    
    ######## Relations ########
    
    public function category()
    {
        return $this->belongsTo(ClinicsCategory::class , 'clinics_category_id');
    }// category

   
    public function phones()
    {
        return $this->hasMany(Phone::class);
        
    }// end phones 


    public function workingDays()
    {
        return $this->hasMany(WorkingDay::class)->with('periods');
    }// end of working day

    public function offDays()
    {
        return $this->hasMany(OffDay::class);
    }// end of vacations


    public function rates()
    {
        return $this->hasMany(Rate::class);
    }



}
