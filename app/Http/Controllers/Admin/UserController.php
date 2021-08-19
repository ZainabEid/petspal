<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\PetsCategory;
use App\Models\Report;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $user;

    public function __construct(UserRepositoryInterface $user){

        $this->user = $user;

        $this->middleware('permission:create_user,admin',['only' =>['create']]);
        $this->middleware(['permission:read_user,admin'])->only('index','show');
        $this->middleware(['permission:update_user,admin'])->only('edit','update');
        $this->middleware(['permission:delete_user,admin'])->only('distroy');
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
           $users = $this->user->allPaginated(10);
            return view('admin.users._users_rows',compact('users')) ;
        }
        
       return view('admin.users.index');
    }


    
    public function create()
    {
        $pets_categories = PetsCategory::all();

        return view('admin.users.create',compact('pets_categories'));
    }

   // stored in livewire
    public function store(UserRequest $request)
    {
        $this->user->create($request->all());

        session()->flash('success', __('added-successfuly'));

        return redirect()->route('admin.users.index');
    }

   
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    
    public function update(UserRequest $request, User $user)
    {
        $this->user->update( $user->id, $request->all() );

        session()->flash('success', __('updated-successfuly'));

        return redirect()->route('admin.users.index');
    }

   
    public function destroy(User $user)
    {
        $this->user->deleteById($user->id); 
      
        
        session()->flash('success', __('deleted-successfuly'));

        return redirect()->back();
    }

    public function blockList(User $user)
    {
        $users = $user->blocks()->get();

        return view('admin.users.block-list',compact('users'));
    }

    public function reportList(User $user)
    {

        $reports = Report::where('reporter_id' , $user->id )->get();

        return view('admin.users.report-list',compact('reports'));
    }

  
    
}
