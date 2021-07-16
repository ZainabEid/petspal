<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// admin auth routes
Route::group([],function () {
    

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Reset Password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Confirm Password
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Verify Email
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

});


// auth admins only
Route::middleware('admin.auth:admin')->group(function () {


    // admins
    Route::put('admins/inline-update','AdminController@inlineUpdate')->name('admins.inline-update');
    Route::resource('admins', 'AdminController');

    // permissions
    Route::resource('roles', 'RoleController');

    // clinics
    Route::get('/clinics/show-working-hours/{clinic}', 'ClinicController@showWorkingHours')->name('clinics.show-working-hours');
    Route::get('/clinics/show-gallery/{clinic}', 'ClinicController@showGallery')->name('clinics.show-gallery');
    Route::get('/clinics/add-work-period', 'ClinicController@addWorkPeriod')->name('clinics.add-work-period');
    Route::get('/clinics/add-off-day', 'ClinicController@addOffDay')->name('clinics.add-off-day');
    Route::get('/clinics/add-phone', 'ClinicController@addPhone')->name('clinics.add-phone');
    Route::resource('clinics', 'ClinicController');

    // clincis-category
    Route::resource('clinics-categories', 'ClinicsCategoryController');

    // pets-category
    Route::resource('pets-categories', 'PetsCategoryController');

    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


});


// lang
Route::get('/{lang}', 'DashboardController@changeLanguage')->name('change-lang');
