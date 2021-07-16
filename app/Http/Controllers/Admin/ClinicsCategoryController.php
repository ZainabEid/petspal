<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicsCategoryRequest;
use App\Models\ClinicsCategory;
use App\Repositories\Eloquent\Contracts\ClinicsCategoryInterface;

class ClinicsCategoryController extends Controller
{
   
    protected $clinics_category; 

    public function __construct(ClinicsCategoryInterface $clinics_category)
    {
        $this->clinics_category = $clinics_category;
        
        $this->middleware('permission:create_admin,admin',['only' =>['create']]);
        $this->middleware(['permission:read_admin,admin'])->only('index','show');
        $this->middleware(['permission:update_admin,admin'])->only('edit','update');
        $this->middleware(['permission:delete_admin,admin'])->only('distroy');

    }
      
    public function index()
    {
       $clinics_categories = $this->clinics_category->all();

       return view('admin.clinics-categories.index', compact('clinics_categories'));
        
    } // end of index


    public function create()
    {
        return view('admin.clinics-categories.create');

    } // end of create
    

    public function store(ClinicsCategoryRequest $request)
    {
        $this->clinics_category->create([
            'name' =>  ['en' => $request->name[0], 'ar' => $request->name[1]],
            'description' =>  ['en' => $request->description[0], 'ar' => $request->description[1]],
            ]
        );
        
        session()->flash('success', __('added-successfuly'));

        return redirect()->route('admin.clinics-categories.index');
        
    }// end of store

    
    public function show(ClinicsCategory $clinics_category)
    {
        return view('admin.clinics-categories.show',compact('admin'));
        
    } // end of show

   
    public function edit(ClinicsCategory $clinics_category)
    {

        return view('admin.clinics-categories.edit', compact('clinics_category'));

    }// end of edit
    

    public function update(ClinicsCategoryRequest $request, ClinicsCategory $clinics_category) 
    {
        $this->clinics_category->update( $clinics_category->id,[
            'name' =>  ['en' => $request->name[0], 'ar' => $request->name[1]],
            'description' =>  ['en' => $request->description[0], 'ar' => $request->description[1]],
            ]
        );

        session()->flash('success', __('updated-successfuly'));

        return redirect()->route('admin.clinics-categories.index');
    }// end of update


        
    public function destroy(ClinicsCategory $clinics_category)
    {
        $this->clinics_category->deleteById($clinics_category->id); 

        session()->flash('success', __('deleted-successfuly'));

        return redirect()->back();

    } // end of destroy

}// end of controller
