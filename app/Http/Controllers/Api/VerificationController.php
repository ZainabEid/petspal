<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyAccount;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    use VerifiesEmails;

    
    public function __construct()
    {
        $this->middleware('auth:api')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // not used
    public function index()
    {
        dd('index');
        return view('verification.index');
    }

    // name varify gives 403 invalid signature error
    public function verifyCode(Request $request) {
        
        $request->validate([
            'code' => 'required|integer|max:9999'
        ]);

        $user = User::findOrFail($request->user);
       
        if(! $user){
            return response()->json(["error" => "User is not Exist."]);
        }
        
        
        // if verivication code is correct
        if ($request->code == $user->code) {

            // if code expired
            if ($user->code_expires_at->lt(now())){
                
                $user->resetCode();
                return response()->json(["error" => __("The code is Expired. Please resend to get new verification code")]);
            }
           

            $user->resetCode();
            $user->verified();
            event(new Verified($user));
            return response()->json(["message" => __("verified")], 400);
        }

        return response()->json(["message" => "Invalid/Expired Verification Code provided."], 401);
    }
    
    public function resendCode( Request $request) {

        $user = User::findOrFail($request->user);

        $user->sendEmailVerificationCode();

        return response()->json(["message" => "The code have been send again, Please check your email."], 401);
    }

    // not used
    public function verifyWithMailLink(Request $request)
    {
          // 1. login
          Auth::loginUsingId($request->route('id'));

          // 2. check if url expired 
          if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
              throw new AuthorizationException();
              return response()->json(["error" => "Invalid/Expired url provided."], 401);
          }
  
          // 3. check the hashed code 
          if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
              throw new AuthorizationException();
              return response()->json(["error" => " getEmailForVerification error."], 401);
          }
  
          // 4. check already verified
          if ($user->hasVerifiedEmail()) {
              return response()->json(["message" => "Already verified."], 400);
          }
  
          // 5. send verified event 
          if ($user->markEmailAsVerified()) {
              event(new Verified($user));
          }
  
         // 6. response to api as verified
          if ($request->wantsJson()) {
              return response()->json(["message" => __("verified")], 400);
  
          }
  
          // return redirect()->to('/');
    }

    // not used
    public function resendVerificationWithEmail(Request $request)
    {
        
        $user = User::findOrFail($request->user);
        
        if ($user->hasVerifiedEmail()) {
            return response()->json(["message" => __("Already verified.")], 400);
        }
       
    
        $user->sendEmailVerificationNotification();
    
        if ($request->wantsJson()) {
            return response()->json(["message" => __("Email verification Code is sent to your email id")], 400);

        }

        // return back()->with('resent', true);
    }

}
