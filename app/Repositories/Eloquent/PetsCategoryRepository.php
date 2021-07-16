<?php
namespace App\Repositories\Eloquent;

use App\Models\PetsCategory;
use App\Repositories\Eloquent\Contracts\PetsCategoryInterface;

class PetsCategoryRepository extends BaseRepository implements PetsCategoryInterface
{
    protected $model;

    public function __construct(PetsCategory $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

}

