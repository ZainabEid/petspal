<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable =[
        'clinic_id', 'day',
    ];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }// end of clinic

    public function periods()
    {
        return $this->hasMany(WorkingHour::class, 'working_day_id');
    }// end of periods
}
