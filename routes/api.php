<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// auth routes 
Route::group([],function () {
    
    // authentication
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    // verification
    Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify'); 
    Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

    
});


// authenticated routs
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('me', 'AuthController@me');
    Route::get('test', 'AuthController@test');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// authenticated routs
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
