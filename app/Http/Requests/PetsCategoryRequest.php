<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetsCategoryRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'name' => 'required|array|min:1',
            'description' => 'required|array|min:1',
        ];
    }
}
