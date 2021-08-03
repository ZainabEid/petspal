<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// auth routes 
Route::group([],function () {
    
    // authentication
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    

    // verification
    Route::get('email/verify-code/', 'VerificationController@verifyCode'); 
    Route::get('email/verify/index', 'VerificationController@index'); 
    Route::get('email/resend-code', 'VerificationController@resendCode');

    
});


// authenticated routes
Route::middleware(['auth:sanctum','verified_by_code'])->group(function () {

    // user loggout
    Route::post('logout', 'AuthController@logout');

    // returns user
    Route::get('me', 'AuthController@me');

    //clinics
    Route::apiResource('clinics', 'ClinicController');
    Route::put('clinics/{clinic}/rate', 'ClinicController@rate');

    //users
    Route::apiResource('users', 'UserController')->except('index','store');
 
    // users / accounts
    Route::put('users/{user}/accounts/{account}/switch', 'AccountController@switch');
    Route::get('accounts/adoption-accounts', 'AccountController@adoptionAccounts');
    Route::get('accounts/normal-accounts', 'AccountController@NormalAccounts');
    Route::apiResource('users.accounts', 'AccountController');


    // //pages
    // Route::get('/support', 'WebsiteController@support');
    // Route::get('/help', 'WebsiteController@help');
    // Route::get('/privace', 'WebsiteController@privace');
    // Route::get('/terms', 'WebsiteController@terms');
   
    
    

    //  // timeline [all categories] [ recent posts]
    //  Route::get('timeline', 'TimelineController');
    
    //  // posts
    //  Route::resource('users.posts', 'PostController');
 
    //  //likes
    //  Route::get('users/{user}/posts/{post}/like','LikeController@like')->name('posts.like');
    //  Route::get('users/{user}/posts/{post}/unlike','LikeController@unlike')->name('posts.unlike');
 
     
    //  // comments
    //  Route::resource('posts.comments', 'CommentController');
    
    //  // tags
    //  Route::resource('tags', 'TagController');
 
 
    //  // notification
 
    
    
     
   

});

// fallback unauthorized
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@petspals.com'], 404);
});
