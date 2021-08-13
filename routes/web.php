<?php

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard');
Route::get('/{lang}', 'HomeController@changeLanguage')->name('change-lang');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test/test', function(){
   return view('test');
})->name('test');

Route::get('/test/chat', function(){
   event(new Message('Zainab','hello world'));
   return ['success'=>true]; 
})->name('test.chat');



Route::get('/chat/chat', function () {
   return view('index');
});

Route::post('/send-message', function (Request $request) {
   event( new Message($request->message));
   return ['success'=>true]; 
});

