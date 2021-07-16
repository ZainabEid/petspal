<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable=[
        'working_day_id', 'open_at', 'close_at','title'
    ];

    public function day()
    {
        return $this->belongsTo(workingDay::class,'working_day_id');
    }// end of day()


}// end of model

