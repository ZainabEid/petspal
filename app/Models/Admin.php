<?php

namespace App\Models;

use App\Notifications\Admin\Auth\ResetPassword;
use App\Notifications\Admin\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    use HasRoles;

    protected $guard_name = 'admin';
  
    protected $fillable = [
        'name', 'email', 'password',
    ];
    

    protected $appends =[
        'role'
    ];

   
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // chatting methods
    public function lastNewMessages()
    {
        return null;
    }



  
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

   
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }


    ### getting attributes ###

    public function getRoleAttribute()
    {
        return $this->getRoleNames()->first();
    }


    ##### Relations #####
   
    // public function conversations()
    // {
    //     return $this->hasMany(conversation::class,['admin_id','to_admin_id']);
    // }

}