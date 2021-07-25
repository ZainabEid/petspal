<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class ClinicsCategory extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable =[
        'name', 'description'
    ];
    
    public $translatable = ['name', 'description'];


    function clinics()
    {
        return $this->hasMany(Clinic::class,'clinics_category_id');
    }
}
