<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class Clinic extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $fillable =[
        'name', 'description' , 'clinics_categrory_id' , 'address' ,'social', 'working_hours' , 'contacts', 'rate' , 'media'
    ];

    protected $appends=[
        'facebook', 'twitter','instagram'
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


    
    public function gallery()
    {
        return $this->morphMany(Media::class,'mediable');
    }

    // public function rate()
    // {
    //     return 4.5;
    //     // return $this->hasMany(Rate::class);
    // }



}
