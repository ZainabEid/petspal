<?php

namespace App\Http\Requests\Traits;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

trait ApiRequest
{
    public function authorize()
    {
        if ( request()->is('api/*') || $this->expectsJson() ) {

            return Auth::id() === request()->route('user')->id;
        }
        return true;
    }

    
    public function failedAuthorization()
    {
        if ( request()->is('api/*') || $this->expectsJson() ) {

            throw new AuthorizationException("You don't have the authority", 403);
        }

    }

  
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if (request()->is('api/*') || $this->expectsJson()) {

            $response = new Response(['error' => $validator->errors()->first()], 422);

            throw new ValidationException($validator, $response);
        }
    }
}