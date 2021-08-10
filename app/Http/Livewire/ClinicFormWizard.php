<?php

namespace App\Http\Livewire;

use App\Repositories\Eloquent\Contracts\ClinicInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ClinicFormWizard extends Component
{
    
    use AuthorizesRequests;
    
    protected  $user;
    public $categories;

    public $currentStep = 1;
    public $address, $category_id;
    public $name, $description, $social,$phones , $working_hours, $off_days , $gallery =[];
    public $phonesInput =[];
    public $successMsg = '';
    public $i = 1;

    public function mount($categories )
    {
        $this->user = App::make('App\Repositories\Eloquent\Contracts\ClinicInterface');
       
        $this->categories=$categories;
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->phonesInput ,$i);
    }


    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'category_id' => 'required' ,
            'name' => 'required|array|min:1',
            'description' => 'required|array|min:1',
            'address' => 'nullable|string' ,
            'phones' => ['required', 'array', 'min:1'],
            'phones.0' => ['required'],
            // 'phones.*' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
            'social' =>'' ,
        ]);
 
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {

        $this->submitForm();
  
    }

    public function submitForm()
    {
        $this->authorize('create_clinic');

        $this->user = App::make('App\Repositories\Eloquent\Contracts\ClinicInterface');

        $this->user->create($this);
  
        // send notification to whom authorize to read user
        // $this->successMsg = 'User successfully created.';
  
        $this->clearForm();
  
        $this->currentStep = 1;

        return  redirect()->route('admin.users.index');
    }

    public function back($step)
    {
        $this->currentStep = $step;    
    }

    public function clearForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }
    
    public function render( ClinicInterface $user)
    {
        $categories = $this->categories;
        return view('livewire.clinic-form-wizard',compact('categories'));
    }
}
