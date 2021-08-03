<?php

namespace App\Http\Controllers\Api;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\ClinicsCategoryResource;
use App\Repositories\Eloquent\Contracts\ClinicInterface;
use App\Repositories\Eloquent\Contracts\ClinicsCategoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    
    protected $clinic; 
    protected $categories; 

    public function __construct(ClinicInterface $clinic , ClinicsCategoryInterface $categories)
    {
        $this->clinic = $clinic;
        $this->categories = $categories;
        
    }// end of constructor
      
    public function index()
    {
       $clinics = $this->clinic->allPaginated();

       return ClinicResource::collection($clinics);
        
    } // end of index

    
    public function show(Clinic $clinic)
    {
        $categories = $this->categories->all($columns =['id','name']);

        // return two resoures not working
        return [new ClinicResource($clinic) , new ClinicsCategoryResource($categories)];
    } // end of show

    public function rate(Clinic $clinic ,Request $request)
    {
        $request->validate([
            'rate'=>'required|integer|min:1|max:5'
        ]);
       
        $clinic = $this->clinic->rate( $clinic, $request->rate, Auth::id());

        return new ClinicResource($clinic);
    }

}
