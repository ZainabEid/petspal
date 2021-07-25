<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;


Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard');
Route::get('/', [DashboardController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{lang}', 'HomeController@changeLanguage')->name('change-lang');

