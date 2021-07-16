<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\ClinicsCategory;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface ClinicsCategoryInterface extends EloquentInterface
{
    public function __construct(ClinicsCategory $clinics_category);
   
}