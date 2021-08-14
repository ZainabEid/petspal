<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_name', 'admin_id','to_admin_id'
    ];

    protected $appends =[
        'talked_admin'
    ];


    ##### getting attributes #####

    public function getTalkedAdminAttribute()
    {
        
        if( $this->admin_id === auth('admin')->id() ){

            return Admin::findOrFail($this->to_admin_id); 
        }


        if( $this->to_admin_id === auth('admin')->id() ){

            return Admin::findOrFail($this->admin_id); 
        }

    }


    public function LastMessageTime()
    {
        if($this->messages->count() > 0){

            return $this->messages->last()->created_at;
        }
        return now();
    }



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->channel_name =  'conversation'.'-'.$model->admin_id.'-'.$model->to_admin_id;;
        });
    }



   


    ##### Relations #####

    public function starter()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function recipient()
    {
        return $this->belongsTo(Admin::class,'to_admin_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    ##### End Relations #####


}
