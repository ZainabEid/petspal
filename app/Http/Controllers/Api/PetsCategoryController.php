<?php

namespace App\Http\Controllers\Api;

use App\Models\PetsCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetsCategoryRequest;
use App\Http\Resources\PetsCategoryResource;
use App\Repositories\Eloquent\Contracts\PetsCategoryInterface;

class PetsCategoryController extends Controller
{

    protected $pets_category; 

    public function __construct(PetsCategoryInterface $pets_category)
    {
        $this->pets_category = $pets_category;
    }
      
    public function index()
    {
       $pets_categories = $this->pets_category->all();

       return PetsCategoryResource::collection( $pets_categories );
        
    } // end of index


 
}
