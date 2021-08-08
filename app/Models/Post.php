<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Traits\Likes;
use Optix\Media\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model implements Likeable {
    use HasFactory , HasMedia , SoftDeletes ,Likes;
    
    
    protected $fillable = [
        'body' , 'user_id' 
    ];

    protected $appends =[
        'first_media' ,'time_ago','body_with_linked_tags'
    ];

    // make post's body's tags looks in links
    public function getBodyWithLinkedTagsAttribute()
    {
        return $this->hashtag_links($this->body);
    }

    function hashtag_links($string) {
        preg_match_all('/#(\w+)/', $string, $matches);
        if($matches){
            if(array_key_exists(0, $matches)){
                $array = $matches[0];
                foreach ($array as $key => $match) {
                    // $route = route('admin.tags.show',$match);
                    $route = $match;
                    $string= str_replace("$match" ,"<a class='text-danger' href='$route'>$match</a>", $string);
                }
            }
        }
        return $string;
    }
    
    // return first image from a post collection
    public function getFirstMediaAttribute()
    {
        if ( $this->getFirstMediaUrl('collection') ) {

            return $this->getFirstMediaUrl('collection');
        }

        return  asset('public/posts/default.png') ;
    }

    public function getTimeAgoAttribute()
    {
        return  $this->getTimeAgo($this->created_at) ;
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
