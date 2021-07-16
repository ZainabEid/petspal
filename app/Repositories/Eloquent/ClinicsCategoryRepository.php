<?php
namespace App\Repositories\Eloquent;

use App\Models\ClinicsCategory;
use App\Repositories\Eloquent\Contracts\ClinicsCategoryInterface;

class ClinicsCategoryRepository extends BaseRepository implements ClinicsCategoryInterface
{
    protected $model;

    public function __construct(ClinicsCategory $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

}

