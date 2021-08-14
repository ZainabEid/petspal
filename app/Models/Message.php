<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable =[
        'sender_id','reciever_id','message_content','message_type',
    ];

    public function sender()
    {
        return $this->belongsTo(Admin::class);
    }

    public function reciever()
    {
        return $this->belongsTo(Admin::class);
    }
}
