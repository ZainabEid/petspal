<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// auth routes 
Route::group([],function () {
    
    // authentication
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    // verification
    Route::get('email/verify-code/', 'VerificationController@verifyCode')->name('verification.verify-code'); 
    Route::get('email/verify/index', 'VerificationController@index')->name('verification.index'); 
    Route::get('email/resend-code', 'VerificationController@resendCode')->name('verification.resend-code');

    
});


// authenticated routs
Route::middleware(['auth:sanctum','verified_by_code'])->group(function () {
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
