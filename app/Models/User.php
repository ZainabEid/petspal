<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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

    public function account()
    {
        return $this->accounts()->first();
    }

    
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


    ##### END RELATIONS #####
}
