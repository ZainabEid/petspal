<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Contracts\Auth\Access\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Roles\Contracts\RoleRepositoryInterface;
use App\Repositories\Eloquent\Contracts\AdminRepositoryInterface;

class AdminController extends Controller
{
    protected $admin; 
    protected $roles;

    public function __construct(AdminRepositoryInterface $admin,RoleRepositoryInterface $roles )
    {
        $this->admin = $admin;
        $this->roles = $roles;

        // $this->authorizeResource(Admin::class,'admins');
        
        // $this->middleware(['role:super_admin'] );
       
        // $this->middleware('permission:create_admin,admin',['only' =>['create']]);
        $this->middleware(['permission:read_admin,admin'])->only('index');
        // $this->middleware(['permission:update_admin,admin'])->only('edit');
        // $this->middleware(['permission:delete_admin,admin'])->only('distroy');

    }
    
    
    public function authorize($ability, $arguments = [])
    {
        [$ability, $arguments] = $this->parseAbilityAndArguments($ability, $arguments);

        return app(Gate::class)->forUser(Auth::guard('admin')->user())->authorize($ability, $arguments);
    }
   
    public function index()
    {

        // abort_if( Gate::forUser(Auth::guard('admin')->user())->denies('read_admin'), Response::HTTP_FORBIDDEN , '403 Formbidedn');
        // $this->authorize('read_admin');
        
        $admins = $this->admin->all();

       foreach( $admins as $admin ){

           $admin->role = $admin->getRoleNames()->first();
       };

       return view('admin.admins.index', compact('admins'));
        
    } // end of index

    public function create()
    {
        $this->authorize('create_admin');
        
        $roles = $this->roles->allNames();

        return view('admin.admins.create', compact('roles'));

    } // end of create

    public function store(AdminRequest $request)
    {
        $this->authorize('create_admin');

        $this->admin->create([
            'name' =>  $request['name'],
            'email' =>  $request['email'],
            'password' => bcrypt( $request['password']),
            ], 
            [$request->role]
        );

        
        session()->flash('success', __('added-successfuly'));

        return redirect()->route('admin.admins.index');
        
    }// end of store

    
    public function show(Admin $admin)
    {
        $this->authorize('read_admin');

        return view('admin.admins.show',compact('admin'));
        
    } // end of show

   
    public function edit(Admin $admin)
    {

        $this->authorize('edit_admin');



        // super admin cant be edited
        if( Auth::guard('admin')->user()->role != 'super_admin' && $admin->role == 'super_admin' ){

            session()->flash('error', __('can\'t edit super admin'));

            return redirect()->back();
        }



        $roles = $this->roles->allNames();

        return view('admin.admins.edit', compact('admin','roles'));

    }// end of edit

    public function update(AdminRequest $request, Admin $admin) 
    {
        $this->authorize('edit_admin');

        
        // super admin cant be edited
        if( Auth::guard('admin')->user()->role != 'super_admin' && $admin->role == 'super_admin' ){

            session()->flash('error', __('can\'t edit super admin'));

            return redirect()->back();
        }

        $this->admin->update( $admin->id, [
            'name' =>  $request['name'],
            'email' =>  $request['email'],
            'password' => $request['password'] != null ?  Hash::make( $request['password']) : $admin->password,
            ],
            [$request->role]
        );

        session()->flash('success', __('updated-successfuly'));

        return redirect()->route('admin.admins.index');
    }// end of update


    public function inlineUpdate(AdminRequest $request)
    {
        $this->authorize('edit_admin');

        // super admin cant be edited
        if( Auth::guard('admin')->user()->role != 'super_admin' && $this->admin->role == 'super_admin' ){

            session()->flash('error', __('can\'t edit super admin'));

            return redirect()->back();
        }

        if($request->ajax()){

            $this->admin->update($request->pk,[

                $request->name => $request->value
            ]);

            return response()->json(['success' => true]);
        }

    }// end of inline update



    
    public function destroy(Admin $admin)
    {
        $this->authorize('delete_admin' , $admin);

        // super admin cant be deleted
        if($admin->role == 'super_admin'){
            session()->flash('error', __('can\'t delete super admin'));

            return redirect()->back();
        }

        
        if($admin->id == Auth::id()){

            $this->admin->deleteById($admin->id); 

            session()->flash('error', __('can\'t delete super admin'));

            return redirect()->route('admin.login');
        }


        $this->admin->deleteById($admin->id); 

        session()->flash('success', __('deleted-successfuly'));

        return redirect()->back();

    } // end of destroy


} // end of admin controller
