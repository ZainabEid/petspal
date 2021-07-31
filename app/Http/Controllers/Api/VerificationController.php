<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
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

    public function verify( Request $request) {

        // 1. login
        Auth::loginUsingId($request->route('id'));

        // 2. check if url expired 
        if (! hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
            throw new AuthorizationException();
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        // 3. check the hashed code 
        if (! hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
            throw new AuthorizationException();
            return response()->json(["msg" => " getEmailForVerification error."], 401);
        }

        // 4. check already verified
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(["msg" => "Already verified."], 400);
        }

        // 5. send verified event 
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

       // 6. response to api as verified
        if ($request->wantsJson()) {
            return response()->json(["msg" => __("verified")], 400);

        }

        // return redirect()->to('/');
    }
    
    public function resend(Request $request) {

        dd('resend');
        
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(["msg" => __("Already verified.")], 400);
        }
       
    
        $request->user()->sendEmailVerificationNotification();
    
        if ($request->wantsJson()) {
            return response()->json(["msg" => __("Email verification Code is sent to your email id")], 400);

        }

        // return back()->with('resent', true);
    }
}
