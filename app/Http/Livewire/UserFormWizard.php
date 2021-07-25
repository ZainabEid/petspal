<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Eloquent\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\App;

class UserFormWizard extends Component
{
    use AuthorizesRequests;
    
    protected  $user;
    public $pets_categories;

    public $currentStep = 1;
    public $name, $email, $password ,$password_confirmation,$pets_category_id,$is_adoption;
    public $successMsg = '';

    public function mount($pets_categories )
    {
        $this->user = App::make('App\Repositories\Eloquent\Contracts\UserRepositoryInterface');
       
        $this->pets_categories=$pets_categories;
    }


    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['sometimes','required', 'string', 'min:8', 'confirmed'],
        ]);
 
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'pets_category_id' => 'required',
            'is_adoption' => 'required|boolean',
        ]);

        $this->submitForm();
  
    }

    public function submitForm()
    {
        $this->authorize('create_user');

        $this->user = App::make('App\Repositories\Eloquent\Contracts\UserRepositoryInterface');

        $this->user->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'pets_category_id' => $this->pets_category_id,
            'is_adoption' => $this->is_adoption
        ]);
  
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
    
    public function render( UserRepositoryInterface $user)
    {
      
        $pets_categories = $this->pets_categories;
        return view('livewire.user-form-wizard',compact('pets_categories'));
    }
}
