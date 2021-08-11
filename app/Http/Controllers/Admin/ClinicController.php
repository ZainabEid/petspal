<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\Repositories\Eloquent\Contracts\ClinicInterface;
use App\Repositories\Eloquent\Contracts\ClinicsCategoryInterface;

class ClinicController extends Controller
{
    
    protected $clinic; 
    protected $categories; 

    public function __construct(ClinicInterface $clinic , ClinicsCategoryInterface $categories)
    {
        $this->clinic = $clinic;
        $this->categories = $categories;
        
        $this->middleware('permission:create_clinic,admin',['only' =>['create']]);
        $this->middleware(['permission:read_clinic,admin'])->only('index','show');
        $this->middleware(['permission:update_clinic,admin'])->only('edit','update');
        $this->middleware(['permission:delete_clinic,admin'])->only('distroy');

    }// end of constructor
      
    public function index()
    {
       $clinics = $this->clinic->all();

       return view('admin.clinics.index', compact('clinics'));
        
    } // end of index


    public function create()
    {
        $categories = $this->categories->all($columns =['id','name']);
       
        return view('admin.clinics.create',compact('categories'));

    } // end of create
    

    public function store(ClinicRequest $request)
    {
        $this->clinic->create($request->toArray() );
        
        session()->flash('success', __('added-successfuly'));

        return redirect()->route('admin.clinics.index');
    }// end of store

    
    public function show(Clinic $clinic)
    {
        return view('admin.clinics.show',compact('admin'));
    } // end of show

   
    public function edit(Clinic $clinic)
    {
        $categories = $this->categories->all($columns =['id','name']);
        $clinic->phones = $clinic->phones->pluck('phone');
        return view('admin.clinics.edit', compact('clinic','categories'));

    }// end of edit
    

    public function update(ClinicRequest $request, Clinic $clinic) 
    {
        $this->clinic->update( $clinic->id,$request->toArray() );

        session()->flash('success', __('updated-successfuly'));

        return redirect()->route('admin.clinics.index');
    }// end of update


        
    public function destroy(Clinic $clinic)
    {
        $this->clinic->deleteById($clinic->id); 

        session()->flash('success', __('deleted-successfuly'));

        return redirect()->route('admin.clinics.index');

    } // end of destroy



    // add extra phone field to form
    public function addPhone()
    {
        return view('admin.clinics.includes._extra_phone');
    }

    // add extra-period field to form
    public function addWorkPeriod(Request $request)
    {
        $day = $request->day;
        $period_index = $request->period_index;
        return view('admin.clinics.includes._extra_period',compact('day','period_index'));
    }

    
    // add off day field to form
    public function addOffDay(Request $request)
    {
        $off_day_index = $request->off_day_index;
        return view('admin.clinics.includes._off_day', compact('off_day_index'));
    }

    
    // show Gallery modal
    public function showGallery(Clinic $clinic)
    {
        $gallery = $clinic->gallery();

        return view('admin.clinics.includes._gallery_card',compact('gallery'));
    }

      
    // show Working Hours modal
    public function showWorkingHours(Clinic $clinic)
    {
        $working_days = $clinic->workingDays;
        return view('admin.clinics.includes._working_hours_card',compact('working_days'));
    }


}
