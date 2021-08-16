<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Clinic;
use App\Models\ClinicsCategory;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function __construct()
    {
       $this->middleware('admin.auth:admin')->except('changeLanguage');
    }// end of constructor

   
    public function index() {
        $users_count = User::all()->count();
        $admins_count = Admin::all()->count();
        $clinics_count = Clinic::all()->count();
        $categoris_count = ClinicsCategory::all()->count();
        $posts = Post::paginate(5);
return view('admin.dashboard', compact('users_count','admins_count','clinics_count','categoris_count','posts'));
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
        // dd($request->body);
       
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
