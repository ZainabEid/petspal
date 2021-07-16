<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable=[
        'src', 'type', 'alt'
    ];

    public function mediable()
    {
        return $this->morphTo();
    }

}
