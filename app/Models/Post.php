<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Optix\Media\HasMedia;

class Post extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = [
        'body' , 'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function comments()
    {
        $this->hasMany(Comment::class);
    }



    
}
