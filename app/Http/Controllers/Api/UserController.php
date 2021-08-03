<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\PetsCategory;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public $user;

    public function __construct(UserRepositoryInterface $user){

        $this->user = $user;
    }

    public function checkAuthorization(User $user)
    {
        if(Auth::id() != $user->id){
            return response()->json([
                'msg' => 'Unauthorized, '
            ],403);
        }
        
    }

    public function show(User $user)
    {
        $this->checkAuthorization($user);

        return new UserResource($user);
    }

    public function update(User $user, Request $request)
    {
        $this->checkAuthorization($user);
        

        // validation
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable','string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->all()], 422);
        } 

        $user = $this->user->update( $user->id, $request->all() );
       
        return new UserResource($user);
    }
   
    public function destroy()
    {
        // deactivate the auth user
        $this->user->deleteById(Auth::id()); 
        
        Auth::logout();

        return response()->json([
            'msg' => 'your account is deactivated'
        ]);
    }

    
}
