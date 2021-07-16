<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable =[
        'phone', 'clinic_id'
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
