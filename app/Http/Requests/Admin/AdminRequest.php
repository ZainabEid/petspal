<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        // inline edit validation for name and email
        if (request()->ajax()) {

            if (request()->name == 'name') {
                return [
                    'value' => ['required', 'string', 'max:255']
                ];
                
            }
            
            if(request()->name == 'email'){

                return [
                    'value' => ['required', 'string', 'email', 'max:255', Rule::unique('admins' , 'email')->ignore($this->admin ),]
                ];
            }
        }

        if($this->admin && request()->password === null ){
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($this->admin)],
                'password' => ['nullable','string', 'min:8', 'confirmed'],
                'role' => ['sometimes','required',
                        Rule::in(Role::all()->pluck('name')->toArray()),
                    ], 
            ];
        }
      
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($this->admin)],
            'password' => ['sometimes','required', 'string', 'min:8', 'confirmed'],
            'role' => ['sometimes','required',
                    Rule::in(Role::all()->pluck('name')->toArray()),
                ], 
        ];
    }

    public function messages()
    {
    
        if (request()->ajax()) {

            if (request()->name == 'name') {

                return [
                    'value.required' => 'A Name is required',
                    'value.string' => 'A Name should be a string',
                    'value.max' => 'A Name should 255 maximum',
                ];
            }
            
            
            if(request()->name == 'email'){
                
                return [
                    'value.required' => 'A Email is required',
                    'value.string' => 'A Email should be a string',
                    'value.max' => 'A Email should 255 maximum',
                    'value.unique' => 'this Email is alredy taken',
                ];
            }

           

        }


        return [
                
        ];
    }
}
