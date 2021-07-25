<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\PetsCategory;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\UserRepositoryInterface;
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


    public function index()
    {
        $users = $this->user->all();

       return view('admin.users.index', compact('users'));
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

    public function login(User $user)
    {
        Auth::guard('web')->loginUsingId($user->id, $remember = true);
        
        return redirect()->back();
        
    }
}
