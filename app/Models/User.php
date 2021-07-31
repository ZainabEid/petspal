<?php

namespace App\Models;

use App\Contracts\Likeable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    use HasApiTokens;

  
    protected $fillable = [
        'name', 'email', 'password', 'status',
    ];

   
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends =[
        'avatar'
    ];


    public function getAvatarAttribute()
    {
        return $this->account()->avatar;
    }

    // user's main account
    public function account()
    {
        return $this->accounts()->first();
    }


    #### likes functions #####

    public function like(Likeable $likeable): self // likable is post or comment or else
    {
        
        if ($this->hasLiked($likeable)) {
            return $this;
        }

        $this->likes->associate($likeable);

        // (new Like())
        //     ->user()->associate($this)
        //     ->likeable()->associate($likeable)
        //     ->save();

        return $this;
    }

    public function unlike(Likeable $likeable): self
    {
        if (! $this->hasLiked($likeable)) {
            return $this;
        }


        $likeable->likes()->where('user_id',$this->id)->delete;

        // $likeable->likes()
        //     ->whereHas('user', function($q) { 
        //         return $q->whereId($this->id);
        //     })
        //     ->delete();

        return $this;
    }

    public function hasLiked(Likeable $likeable): bool
    {
        if (! $likeable->exists) {
            return false;
        }

        return   $likeable->likes()->where('user_id',$this->id)->exists();

        // return $likeable->likes()
        //     ->whereHas('user', function($q){
        //           $q->whereId($this->id);
        //     })
        //     ->exists();
    }

    #### End likes functions #####
    





    ##### RELATIONS #####

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    // users that are followed by this user
    public function following() {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    // users that follow this user
    public function followers() {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    ##### END RELATIONS #####
}
