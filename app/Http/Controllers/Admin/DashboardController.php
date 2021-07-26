<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function __construct()
    {
       $this->middleware('admin.auth:admin')->except('changeLanguage');
    }// end of constructor

   
    public function index() {
        
        return view('admin.dashboard');
    }// end of index

    public function __call($method,$arameters)
    {
        $page = Page::where('page->en' ,$method)->first();
        return view('admin.pages.page',compact('method','page'));
    }

    public function editPage(Page $page)
    {
        return view('admin.pages.edit',compact('page'));
    }

    public function updatePages(Page $page , Request $request)
    {
        // update data in that page
        $page->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('admin.'.strtolower($page->getTranslation('page', 'en')));
    }



    public function changeLanguage($lang)
    {
        app()->setLocale($lang);
        
        session()->put('locale',$lang);

        return redirect()->back();

    }//end of change language



}
