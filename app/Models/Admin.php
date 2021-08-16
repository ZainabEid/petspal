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
        'role' , 'avatar'
    ];

   
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // get the last 4 conversations
    public function lastNewConversaions()
    {
        if( ! $this->conversations() ||  $this->conversations()->count() == 0){
            return null;
        }
        
        return $this->conversations()->sortByDesc('created_at')->slice(0, 3);
    }

    // get all conversation where admin involved
    public function conversations()
    {
        // if there are no conversation return null
        if( $this->started_conversations()->count() == 0  && $this->recived_conversations()->count() == 0   )
        {
            return  null;
        }
        
        // if there are no started conversations and there are recieved ones
        if( $this->started_conversations()->count() == 0  && $this->recived_conversations()->count() >= 0   )
        {
            return  $this->recived_conversations()->get();
        }
        
        // if there are not recieved conversations and there are started ones
        if( $this->started_conversations()->count() == 0 && $this->recived_conversations()->count() >= 0  )
        {
            return  $this->started_conversations()->get();
        }
       
        // if there are both merge them
        $started_conversations =  $this->started_conversations()->get();
        $recived_conversations =  $this->recived_conversations()->get();
        
        return $conversations = $started_conversations->merge($recived_conversations);
    }




    ##### getting Attributes

    public function getAvatarAttribute()
    {
        if($this->role == 'super_admin'){
            
            return asset('img/avatars/avatar.jpg');
        }

        return 'https://picsum.photos/200/300';

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
   
    
    public function started_conversations()
    {
        return $this->hasMany(Conversation::class,'admin_id');
    }

    public function recived_conversations()
    {
        return $this->hasMany(Conversation::class,'to_admin_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id' );
    }

}