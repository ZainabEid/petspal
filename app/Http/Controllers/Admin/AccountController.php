<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PetsCategory;
use App\Repositories\Eloquent\Contracts\AccountInterface;

class AccountController extends Controller
{
    public $account;


    public function __construct(AccountInterface $account)
    {
        $this->account = $account;

        $this->middleware(['permission:read_acount,admin'])->only('index','show');
        $this->middleware(['permission:update_account,admin'])->only('update');
    }
  
    public function index(User $user)
    {
        $accounts = $this->account->all();
       return view('admin.users.accounts.index',compact('user'));
    }

   

  
  
    public function show(User $user, Account $account)
    {
        $pets_categories = PetsCategory::all();
        return view('admin.users.accounts.show',compact('account','pets_categories'));
    }

   
    public function update(User $user, Request $request, Account $account)
    {
       
        if($request->hasFile('image')){

            $this->account->updateAvatar($account, $request->image);

        }

        $this->account->update( $account->id , $request->toArray() );
        return redirect()->back();
    }

    
    public function destroy(User $user, Account $account)
    {
        //
    }
}
