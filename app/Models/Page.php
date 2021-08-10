<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Optix\Media\HasMedia;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasMedia;
    use HasTranslations;

    public $translatable = [ 'page' , 'title' , 'body'];

    protected $fillable=[
        'page' , 'title' , 'body'
    ];

    protected $appends =[
        'name'
    ];

   

}
