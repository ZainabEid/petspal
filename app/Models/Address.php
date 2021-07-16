<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable =[
        'building_no' , 'street' , 'city' , 'clinic_id'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'clinic_id', 'id');
    }
}
