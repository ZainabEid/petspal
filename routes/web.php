<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/inline-edit', function () {
    $admin = Admin::first();
    return view('inline-edit',compact('admin'));
});

Route::put('/inline-update', function (Request $request)
{
    return response()->json(['status' => 'error' , 'name' =>$request->name ]);
    
})->name('inline-update');




Route::get('/', [DashboardController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{lang}', 'HomeController@changeLanguage')->name('change-lang');

