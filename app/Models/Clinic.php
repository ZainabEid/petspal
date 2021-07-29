<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Optix\Media\HasMedia;
use Spatie\Translatable\HasTranslations;

class Clinic extends Model
{
    use HasFactory;
    use HasTranslations , HasMedia;
    

    public $translatable = ['name', 'description'];

    protected $fillable =[
        'name', 'description' , 'clinics_category_id' , 'address' ,'social', 'working_hours' , 'contacts', 'rate' , 'media'
    ];

    protected $appends=[
        'facebook', 'twitter','instagram' , 
    ];


    ###### gettin attributes ######

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


    // public function rate()
    // {
    //     return 4.5;
    //     // return $this->hasMany(Rate::class);
    // }



}
