<?php

namespace App\Models;

use Optix\Media\hasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasMedia;


    protected $fillable = [
        'name', 'email', 'pets_category_id', 'is_adoption' , 'user_id'
    ];

    protected $appends =[
        'type' , 'recent_posts' ,'avatar'
    ];


    ##### Getting Attributes #####
    public function  getTypeAttribute()
    {
        return  $this->is_adoption ?  'Adoption Account' : 'Normal Account' ;
    }

    public function  getRecentPostsAttribute()
    {
        return  $this->user->posts()->latest()->take(6)->get(); 
    }

    public function  getAvatarAttribute()
    {
        if ( $this->getfirstMediaUrl('avatar') ) {
           
            return  asset( $this->getfirstMediaUrl('avatar') );
        }

        return asset('img/avatars/defaultPet.png');
    }


   

    ##### RELATIONS #####

    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
    public function category()
    {
        return $this->belongsTo(PetsCategory::class, 'pets_category_id');
    }


    ##### END RELATIONS #####
    

}
