<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $rules =[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
        ];
        
        // for updating without password
        if($this->user && request()->password === null ){ 

           $rules +=[
                'password' => ['nullable','string', 'min:8', 'confirmed'],
           ];

        }else{

            $rules +=[
                'password' => ['sometimes','required', 'string', 'min:8', 'confirmed'],
            ];
        }

        return $rules;
    }
}
