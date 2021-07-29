<?php
namespace App\Repositories\Eloquent;

use App\Models\Account;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\Contracts\AccountInterface;
use Optix\Media\MediaUploader;
use App\Models\Media;
use Exception;

class AccountRepository extends BaseRepository implements AccountInterface
{
    protected $model;

    public function __construct(Account $model)
    {
        $this->model =  $model;   
        
    }// end of constructor



    public function create( array $attributes)
    {
        $account =   $this->model->create([
                'user_id' => $attributes['user_id'], 
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


            // update  account
            $account->update([
            'name' => $attributes['name'], 
            'email' => $attributes['email'], 
            'pets_category_id' => $attributes['pets_category_id'], 
            'is_adoption' => $attributes['is_adoption'], 

            ]);

        } catch(\Exception $e){

            DB::rollback();
            // throw new Exception($e->getMessage());
            return back()->withError($e->getMessage());
        }

        
        DB::commit();
        return  $account;

    }

    public function switchAccount(Account $account)
    {
       $account->update([
           'is_adoption' => ! $account->is_adoption,
       ]);
       return $account;
    }

    

}
