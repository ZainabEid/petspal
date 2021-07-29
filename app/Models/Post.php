<?php

namespace App\Models;


use Optix\Media\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model {
    use HasFactory , HasMedia , SoftDeletes ;
    
    
    protected $fillable = [
        'body' , 'user_id' 
    ];

    protected $appends =[
        'first_media'
    ];

    // return first image from a post collection
    public function getFirstMediaAttribute()
    {
        if ( $this->getFirstMediaUrl('collection') ) {

            return $this->getFirstMediaUrl('collection');
        }

        return  asset('public/posts/default.png') ;
    }
    public function getTimeAgo($carbonObject) {
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'], 
            ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'], 
            $carbonObject->diffForHumans()
        );
    }

    public function collection()
    {
        if ( $this->getMedia('collection') &&  $this->getMedia('collection')->count() > 0  ) {
           
            return $this->getMedia('collection');
        }

        return asset('public/posts/default.png') ;
    }


    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class,'taggable')->withTimestamps();
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
