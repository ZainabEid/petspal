<?php

namespace App\Http\Controllers\Admin;

use App\Models\PetsCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetsCategoryRequest;
use App\Repositories\Eloquent\Contracts\PetsCategoryInterface;

class PetsCategoryController extends Controller
{

    protected $pets_category; 

    public function __construct(PetsCategoryInterface $pets_category)
    {
        $this->pets_category = $pets_category;
        
        $this->middleware('permission:create_admin,admin',['only' =>['create']]);
        $this->middleware(['permission:read_admin,admin'])->only('index','show');
        $this->middleware(['permission:update_admin,admin'])->only('edit','update');
        $this->middleware(['permission:delete_admin,admin'])->only('distroy');

    }
      
    public function index()
    {
       $pets_categories = $this->pets_category->all();

       return view('admin.pets-categories.index', compact('pets_categories'));
        
    } // end of index


    public function create()
    {
        return view('admin.pets-categories.create');

    } // end of create
    

    public function store(PetsCategoryRequest $request)
    {
        $this->pets_category->create([
            'name' =>  ['en' => $request->name[0], 'ar' => $request->name[1]],
            'description' =>  ['en' => $request->description[0], 'ar' => $request->description[1]],
            ]
        );
        
        session()->flash('success', __('added-successfuly'));

        return redirect()->route('admin.pets-categories.index');
        
    }// end of store

    
    public function show(PetsCategory $pets_category)
    {
        return view('admin.pets-categories.show',compact('admin'));
        
    } // end of show

   
    public function edit(PetsCategory $pets_category)
    {

        return view('admin.pets-categories.edit', compact('pets_category'));

    }// end of edit
    

    public function update(PetsCategoryRequest $request, PetsCategory $pets_category) 
    {
        $this->pets_category->update( $pets_category->id,[
            'name' =>  ['en' => $request->name[0], 'ar' => $request->name[1]],
            'description' =>  ['en' => $request->description[0], 'ar' => $request->description[1]],
            ]
        );

        session()->flash('success', __('updated-successfuly'));

        return redirect()->route('admin.pets-categories.index');
    }// end of update


        
    public function destroy(PetsCategory $pets_category)
    {
        $this->pets_category->deleteById($pets_category->id); 

        session()->flash('success', __('deleted-successfuly'));

        return redirect()->back();

    } // end of destroy
}
