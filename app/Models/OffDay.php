<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffDay extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable =[
        'title' , 'date' ,'clinic_id'
    ];
    
    ##### Relations #####
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    
}
