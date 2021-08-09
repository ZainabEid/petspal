<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLanguage
{
    
    public function handle(Request $request, Closure $next)
    {
      
        // read the language from the request header
        $locale = $request->header('Language');

        // if the header is missed
        if(!$locale){
            // take the default local language
            $locale = app()->config->get('app.locale');
        }

        // check the languages defined is supported
        if (!array_key_exists($locale, app()->config->get('app.supported_languages'))) {
            // respond with error
            return abort(403, 'Language not supported.');
        }

        // set the local language
        app()->setLocale($locale);

        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Language', $locale);

        // return the response
        return $response;
       
    }
}
