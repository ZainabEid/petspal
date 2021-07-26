<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard');
Route::get('/{lang}', 'HomeController@changeLanguage')->name('change-lang');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


