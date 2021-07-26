<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('welcome');
    }

    public function changeLanguage($lang)
    {
        app()->setLocale($lang);
        
        session()->put('locale',$lang);

        return redirect()->back();

    }//end of change language
}
