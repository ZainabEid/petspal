<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'pets_category_id' => 'required',
            'is_adoption' => 'required|boolean',
        ]);

        $user = $this->user->create($request->toArray());

        $user->sendEmailVerificationNotification();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }



    public function login(Request $request)
    {
       
        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);

    }


    
    public function me(Request $request)
    {
       
        return $request->user();
    }
    
    public function test(Request $request)
    {
        dd('test');
    }
}
