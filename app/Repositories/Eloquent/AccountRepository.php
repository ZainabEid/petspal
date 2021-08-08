<?php
namespace App\Repositories\Eloquent;

use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\Contracts\AccountInterface;
use Optix\Media\MediaUploader;
use App\Models\Media;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class AccountRepository extends BaseRepository implements AccountInterface
{
    protected $model;

    public function __construct(Account $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

    // 
    public function allNormalPaginated(int $pagination=0)
    { 
        return $this->model->where('is_adoption',false)->latest()->paginate($pagination);
    }

    public function allAdoptionPaginated(int $pagination=0)
    {
       return $this->model->where('is_adoption',true)->latest()->paginate($pagination);
    }


    public function create( array $attributes)
    {
      
        $account =   $this->model->create([
                'user_id' => isset($attributes['user_id']) ? $attributes['user_id'] : Auth::id(), 
                'name' => $attributes['name'], 
                'email' => $attributes['email'], 
                'pets_category_id' => $attributes['pets_category_id'], 
                'is_adoption' => 1, // adoption account 
            ]);
            
        return  $account->fresh();

    }


    public function updateAvatar(Account $account, $image)
    {
        DB::beginTransaction();


        try {
        
            if( $account->getFirstMedia('avatar')){

                // delete the old one
                // should be delete file
                $account->getFirstMedia('avatar')->delete();
            //   Media::first()->delete();  
            }


            // create & store image
            $media = MediaUploader::fromFile( $image)
                ->useFileName($account->name.'-avatar.'.$image->extension())
                ->useName($account->name.'-avatar')
                ->upload();

        
            //attatch to account
            $account->attachMedia($media, 'avatar');

        } catch(\Exception $e){

            DB::rollback();
            return back()->withError($e->getMessage());
        }

        
        DB::commit();
        return $account;
    }


    public function update(int $accountId = null, array $attributes)
    {
        
        DB::beginTransaction();

        $account =""; 

        try {
         
            // create account
            $accountId = ($accountId == null ) ? $this->model->id : $accountId;

            $account = $this->findById($accountId);


            // update account
            $account->update([
                'name' => $attributes['name'], 
                'email' => $attributes['email'], 
                'pets_category_id' => $attributes['pets_category_id'], 
            ]);
            

        } catch(\Exception $e){

            DB::rollback();
            return back()->withError($e->getMessage());
        }

        DB::commit();
        return  $account;

    }

    public function switchAccount(Account $account)
    {
         // check if not main user account then cant switch
        if ($account->user->account()->id !== $account->id) {
            
            return $account;
        }

        $account->update([
            'is_adoption' => ! $account->is_adoption,
        ]);
      
       return $account;
    }

    // handle if account is already deleted
    public function deleteOrDeactivate(User $user , Account $account)
    {

        // check if main user account
        if ($user->account()->id === $account->id) {

            // deactivate user
            $user->deactivate();
            
            return $user;
        }

        // delete the account
        $account->delete();

        return $user;
    }

    

}
