<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\Models\PetsCategory;
use App\Repositories\Eloquent\Contracts\AccountInterface;
use App\Repositories\Eloquent\Contracts\PetsCategoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public $account;
    public $pets_categories;

    
    public function __construct(AccountInterface $account, PetsCategoryInterface $pets_categories)
    {
        $this->account = $account;
        $this->pets_categories = $pets_categories;
    }

    public function checkAuthorization(User $user , Account $account=null)
    {
        $check_account =  $account ?  Auth::id() != $account->user()->id : false;
        if(Auth::id() != $user->id ||  $check_account ){
            return response()->json([
                'msg' => 'Unauthorized, '
            ],403);
        }
    }

    
    public function NormalAccounts()
    {
        $accounts = $this->account->allNormalPaginated(5);

        return AccountResource::collection($accounts);
    }

    
    public function adoptionAccounts()
    {
        $accounts = $this->account->allAdoptionPaginated(5);

        return AccountResource::collection($accounts);
         
    } 

  
    public function store(User $user,Request $request)
    {
        $this->checkAuthorization($user);

        // validation
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'pets_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->all()], 422);
        } 
        
       
        $account = $this->account->create($request->all());

        return new AccountResource($account);
    }

  
    public function show(User $user, Account $account)
    {
       
        // move thisa to 404 Exeption handler model not found
        if($account->deleted_at != null){
            return response()->json(['msg' => 'account is deleted'], 422);
        }
        
        return new AccountResource($account);
    }

    public function updateAvatar(User $user,Account $account, Request $request )
    {
            $validator = Validator::make($request->all(),[
            
                'image' => 'image'
            ]);

            if ($validator->fails()) {
                return response()->json(['msg' => $validator->errors()->all()], 422);
            } 
            
            if($request->hasFile('image')){

                $account = $this->account->updateAvatar($account, $request->image);
            }   

            return new AccountResource($account);
    }
    
    public function update(User $user,Account $account, Request $request )
    {
        
        $this->checkAuthorization($user);
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'pets_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->all()], 422);
        } 

        $account = $this->account->update( $account->id , $request->all() );

        return new AccountResource($account);
    }

    // error
    public function destroy(User $user, Account $account)
    {
        $this->checkAuthorization($user);

        $user = $this->account->deleteOrDeactivate($user,$account);

        
        // if addional account is deleted 
        if ($user->is_active()){

            return new AccountResource($user->account());
        }


        // if main account is deactivated

        Auth::logout();

        return response()->json([
            'msg' => 'your account is deactivated'
        ]);

    }


    // 404 error when account is not the main !!
    public function switch(User $user , Account $account)
    {
        $this->checkAuthorization($user);

        // check if not main user account then can't switch
        if ($account->user->account()->id !== $account->id) {
        
            return response()->json([
                'msg' => 'you can only switch your main account'
            ]);
        }

        $account = $this->account->switchAccount($account);
       
        return new AccountResource($account);
    }


   

}
