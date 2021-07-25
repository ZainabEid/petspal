<?php
namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Repositories\Eloquent\Contracts\AdminRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

    // Authorizable
    public function all( array $columns =['*'] , array $relations = [] ){

        return $this->model->with($relations)->get($columns);

    }// end of all 

    public function create(array $attributes , array $roles = [])
    {
        DB::beginTransaction();

        $admin =""; 

        try {
            
            // create admin
            $admin = $this->model->create($attributes);


            // assign roles
            $result =  $admin->assignRole($roles);

            

        } catch(\Exception $e)
        {
            DB::rollback();
            return back()->withError($e->getMessage());
        }
        
        DB::commit();
        
        return  $admin->fresh();
    }// end of create funciton


    public function update(int $adminId = null, array $attributes, array $roles =[])
    {
        DB::beginTransaction();

        $admin =""; 

        try {
            
            // create admin
            $adminId = ($adminId == null ) ? $this->model->id : $adminId;

            $admin = $this->findById($adminId);

            $admin->update($attributes);



            
            // assign roles
            $result = $admin->syncRoles($roles);
            

        } catch(\Exception $e)
        
        {
            DB::rollback();
            return back()->withError($e->getMessage());
        }

        
        DB::commit();
        return  $admin;
    }

    // use Spatie\Permission\Traits\HasRole   in Admin admin 
    public function assignRole($roles)
    { 
        return $this->model->assignRole($roles);
    }
}

