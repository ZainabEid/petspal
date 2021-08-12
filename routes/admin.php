<?php

use App\Events\Message;
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

    // // Reset Password
    // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

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
    Route::delete('/clinics/delete-image/{media}', 'ClinicController@deleteImage')->name('clinics.delete-image');
    Route::resource('clinics', 'ClinicController');

    // clincis-category
    Route::resource('clinics-categories', 'ClinicsCategoryController');

    // pets-category
    Route::resource('pets-categories', 'PetsCategoryController');
   
   
    // Users
    Route::get('users/login/{user}', 'UserController@login')->name('users.login');
    Route::resource('users', 'UserController');

    // users / accounts
    Route::get('users/accounts/switch-account/{account}', 'AccountController@switchAccount')->name('users.accounts.switch-account');
    Route::resource('users.accounts', 'AccountController');

    // Route::resource('profiles', 'ProfileController');

    // posts
    Route::resource('users.posts', 'PostController');

    //change acted user
    Route::get('users/posts/change-user', 'PostController@changeUser')->name('users.posts.change-user');

    //likes
    Route::get('users/{user}/posts/{post}/like','LikeController@like')->name('posts.like');
    Route::get('users/{user}/posts/{post}/unlike','LikeController@unlike')->name('posts.unlike');

    
    // comments
    Route::resource('posts.comments', 'CommentController');
   
    // tags
    Route::resource('tags', 'TagController');


    // notification

    //chat

    //
   
    




    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    //pages
    Route::get('/support', 'DashboardController@support')->name('support');
    Route::get('/about', 'DashboardController@about')->name('about');
    // Route::get('/privace', 'DashboardController@privace')->name('privace');
    // Route::get('/terms', 'DashboardController@terms')->name('terms');
    
    Route::get('/pages/edit/{page}', 'DashboardController@editPage')->name('pages.edit');
    Route::put('/pages/update/{page}', 'DashboardController@updatePages')->name('pages.update');
    
    
    
    
    //livechat
    Route::get('/chat', function(){
        return view('chat');
    })->name('chat');
    
    
    
    Route::post('/send-message', function(Request $request){
        // dd($request->all()); // returns values
        
        event( // cURL error 60: SSL certificate problem: unable to get local issuer certificate
            new Message(
                $request->input('username') ,
                $request->input('message')
            )  
        );    
    
        return ["success"=>true];
    });
});







// lang
Route::get('/{lang}', 'DashboardController@changeLanguage')->name('change-lang');
