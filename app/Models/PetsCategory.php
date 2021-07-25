<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class PetsCategory extends Model
{
    use HasFactory;
    use HasFactory;
    use HasTranslations;

    protected $fillable =[
        'name', 'description'
    ];
    
    public $translatable = ['name', 'description'];

  
    public function accounts()
    {
        return $this->hasMany(Account::class,'pets_category_id');
    }

}

