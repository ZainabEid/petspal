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

    protected $appends =[
        'first_media'
    ];

    public function getFirstMediaAttribute()
    {
        return ;
    }



    public function author()
    {
       return $this->belongsTo(User::class , 'user_id');
    }

    public function comments()
    {
       return $this->hasMany(Comment::class);
    }



    
}
