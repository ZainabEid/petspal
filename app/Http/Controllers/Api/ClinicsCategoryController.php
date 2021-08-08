<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicsCategoryRequest;
use App\Http\Resources\ClinicCategoryResource;
use App\Models\ClinicsCategory;
use App\Repositories\Eloquent\Contracts\ClinicsCategoryInterface;

class ClinicsCategoryController extends Controller
{
   
    protected $clinics_category; 

    public function __construct(ClinicsCategoryInterface $clinics_category)
    {
        $this->clinics_category = $clinics_category;

    }
      
    public function index()
    {
       $clinics_categories = $this->clinics_category->allPaginated();

       return ClinicCategoryResource::collection( $clinics_categories);
        
    } // end of index


   
}// end of controller
