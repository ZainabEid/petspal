<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   
    public function __construct()
    {
       $this->middleware('admin.auth:admin')->except('changeLanguage');
    }// end of constructor

   
    public function index() {
        
        return view('admin.dashboard');
    }// end of index



    public function changeLanguage($lang)
    {
        app()->setLocale($lang);
        
        session()->put('locale',$lang);

        return redirect()->back();

    }//end of change language



}
