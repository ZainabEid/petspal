<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Notifications\VerifyAccount;
use Illuminate\Auth\Notifications\VerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Boolean;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    use HasApiTokens;

  
    protected $fillable = [
        'name', 'email', 'password', 'status','code', 'code_expires_at'
    ];

   
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'code_expires_at' => 'datetime',
    ];

    protected $appends =[
        'avatar'
    ];


    ##### verification Code Methods #####
    public function generateCode()
    {
        $this->timestamps =false;
        $this->code = rand(1000,9999);
        $this->code_expires_at = now()->addMinute(10);
        $this->save();
    }

    public function resetCode()
    {
        $this->timestamps =false;
        $this->code = null;
        $this->code_expires_at = null;
        $this->save();
    }

    public function sendEmailVerificationCode(){
        $this->generateCode();
        $this->notify(new VerifyAccount());
    }

    public function verified(){
        $this->email_verified_at = now();
        $this->save();
    }

    public function is_verified()
    {
        if(! $this->email_verified_at){
            return false;
        }
       
        return true;
    }
     ##### end verification #####




    ######   Getting Attributes  ######
    public function getAvatarAttribute()
    {
        return $this->account()->avatar;
    }

    ######  End Getting Attributes  ######


    // user's main account
    public function account()
    {
        return $this->accounts()->first();
    }


    #####  Activation functions  #####
    public function deactivate()
    {
        $this->status = 0;
        $this->save();
    }

    public function activate()
    {
        $this->status = 1;
        $this->save();
    }

    public function is_active()
    {
        return (Boolean)$this->status;
        
    }

    ##### End Activation functions  #####






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
