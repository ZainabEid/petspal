<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// auth routes 
Route::group([],function () {
    
    // authentication
    Route::get('pets/categories', 'PetsCategoryController@index');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    


    
});

Route::get('/counts','CountsController@index');


// authenticated routes
Route::middleware(['auth:sanctum','verified_by_code','change_lang'])->group(function () {

    
    // verification
    Route::get('email/verify/index', 'VerificationController@index'); // not used
    Route::post('email/verify-code/', 'VerificationController@verifyCode'); 
    Route::get('email/resend-code', 'VerificationController@resendCode');


    
    // user loggout
    Route::post('logout', 'AuthController@logout');

    // returns user
    Route::get('me', 'AuthController@me');

    //clinics
    Route::apiResource('clinics', 'ClinicController');
    Route::put('clinics/{clinic}/rate', 'ClinicController@rate');

    //users
    Route::apiResource('users', 'UserController')->except('index','store');

    // followers / follwing  follow / unfollow
    Route::get('users/{user}/following', 'FollowController@following');
    Route::get('users/{user}/followers', 'FollowController@followers');
    Route::get('users/{user}/following-trigger', 'FollowController@followingTrigger');

    
    // block / unblock / block list
    Route::get('/block-list', 'BlockController@blockList');
    Route::get('users/{user}/block', 'BlockController@block');
    Route::get('users/{user}/unblock', 'BlockController@unblock');
 
    // users / accounts
    Route::put('users/{user}/accounts/{account}/switch', 'AccountController@switch');
    Route::put('users/{user}/accounts/{account}/update-avatar', 'AccountController@updateAvatar');
    Route::get('accounts/adoption-accounts', 'AccountController@adoptionAccounts');
    Route::get('accounts/normal-accounts', 'AccountController@NormalAccounts');
    Route::apiResource('users.accounts', 'AccountController');


    //pages
    Route::get('/support', 'PageController@support');
    Route::get('/about', 'PageController@about');
    // Route::get('/privacy', 'PageController@privacy');
    // Route::get('/terms', 'PageController@terms');
   
    
    // pets_categories
    Route::get('/pets-categories', 'PetsCategoryController@index');

    // clinics_categories
    Route::get('/clinics-categories', 'ClinicsCategoryController@index');

    
    // timeline [all categories] [ recent posts]
    Route::get('/timeline', 'TimelineController@index');
    

    // posts
    Route::apiResource('user.posts', 'PostController');
 
    // comments
    Route::resource('posts.comments', 'CommentController')->except('show');

    //likes
    Route::get('/posts/{post}/like','LikeController@likePost');
    Route::get('/comments/{comment}/like','LikeController@likeComment');
     
    
    // tags
    Route::apiResource('tags', 'TagController')->only('index','show');
 
 
    // notification
    Route::get('send-user-follow-notification/{user}', [NotificationController::class, 'sendUserFollowNotification']);
    Route::get('/notifications', [NotificationController::class, 'notifications']);
    Route::get('/notifications/read-all', [NotificationController::class, 'readAllNotifications']);
    Route::put('/notifications/update-token', [NotificationController::class, 'updateToken']);
    
     
   

});

// fallback unauthorized
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@petspals.com'], 404);
});
