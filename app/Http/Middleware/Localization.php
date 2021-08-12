<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
   
    public function handle(Request $request, Closure $next)
    {
        // if not api
        if (!request()->expectsJson()) {

            if(session()->has('locale')){
                app()->setLocale(session()->get('locale'));
            }
    
    
            return $next($request);
        }
        

        return $next($request);

        
    }
}
