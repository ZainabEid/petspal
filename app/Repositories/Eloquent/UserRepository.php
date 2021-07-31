<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model ;

    public function __construct(User $user)
    {
        $this->model =  $user;   
    }

    public function create(array $attributes)
    {
        DB::beginTransaction();

        $user =""; 

        try {
            
            // create user
            $user = $this->model->create([
                'name' => $attributes['name'], 
                'email' => $attributes['email'], 
                'password' => bcrypt( $attributes['password']), 
            ]);


            // create user account
            $account =  $user->accounts()->create([
                'name' => $attributes['name'], 
                'email' => $attributes['email'], 
                'pets_category_id' => $attributes['pets_category_id'], 
                'is_adoption' => $attributes['is_adoption'], 

            ]);

            

        } catch(\Exception $e)
        {
            DB::rollback();
            return back()->withError($e->getMessage());
        }
        
        DB::commit();

        
        
        return  $user->fresh();
    }

    public function update(int $userId = null , array $attributes)
    {
        try {
            
            // get user
            $userId = ($userId == null ) ? $this->model->id : $userId;

            $user = $this->findById($userId);

            //update user
            $user->update([
                'name' =>  $attributes['name'],
                'email' =>  $attributes['email'],
                'password' => $attributes['password'] != null ?  Hash::make( $attributes['password']) : $user->password,
            
            ]);

        } catch(\Exception $e){

            DB::rollback();
            return back()->withError($e->getMessage());
        }

        
        DB::commit();
        return  $user;
    }
}

