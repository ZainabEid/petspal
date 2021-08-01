<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMailVerificationWithCode
{
    
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (Auth::check() && $user->code) {
            if ($user->code_expires_at->lt(now())) {
               
                $user->resetCode();
                Auth::logout();

                return response()->json([
                    'message' => 'Verification Code Expires , Please Login Again'
                ], 401);

                if (! $request->is('verify')) {
                    // return redirect()->route('verification.index')
                }
            }
        }

        return $next($request);
    }
}
