<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Traits\Likes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model implements Likeable
{
    use HasFactory , SoftDeletes , Likes;

    protected $fillable =[
        'body' , 'user_id' , 'post_id'

    ];

    protected $appends =[
        'time_ago'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
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

}
