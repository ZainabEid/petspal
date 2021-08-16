<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable =[
        'sender_id','reciever_id','message_content','message_type','conversation_id'
    ];

    protected $appends =[
        'time_ago'
    ];

    public function getTimeAgoAttribute()
    {
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'], 
            ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'], 
            $this->created_at->diffForHumans()
        );
    }

    public function sender()
    {
        return $this->belongsTo(Admin::class,'sender_id','id');
    }

    public function reciever()
    {
        return $this->belongsTo(Admin::class,'reciever_id','id');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    

}
