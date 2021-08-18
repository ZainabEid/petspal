<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyAccount;
use App\Repositories\Eloquent\Contracts\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function getCsrfToken()
    {

        return response()->json([
            '_token' =>  csrf_token()
        ]);
    }

   
    public function register(Request $request)
    {
          // validation
          $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'pets_category_id' => 'required',
            'is_adoption' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        } 
       

        // event(new Registered( $user = $this->user->create( $request->all() ) ));
        $user = $this->user->create( $request->all() );

        $user->sendEmailVerificationCode();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }



    public function login(Request $request)
    {
         // validation
         $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        } 
       
        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        
        if(! $user->is_verified() ){
            return response()->json([ 'msg' => "you need to verify your email"]);
        }

        // activate user if it is in active
        $activated_notice = '';
        if(! $user->is_active()){
            $user->activate();
            $activated_notice = 'welcom back , your account is activated';
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        // $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json([
                'notice' => $activated_notice ,
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);

    }
    
    public function logout(Request $request){
        Auth::user()->tokens()->logout();

        return [
            'message'=>'Logged out'
        ];
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
