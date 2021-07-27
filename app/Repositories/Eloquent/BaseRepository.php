<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Contracts\EloquentInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository  implements EloquentInterface
{

    protected $model ;
    
    public function __construct(Model $model)
    {
        $this->model = $model ;   
    }

    
    public function all( array $columns =['*'] , array $relations = [] ){
        return $this->model->with($relations)->get($columns);
    }


    public function allTrashed(){

        return $this->model->onlyTrashed()->get();
    }
    
   

    public function findById(int $id , array $columns =['*'] , array $relations = [],  array $appends = [] ){

        return $this->model->findOrFail($id );

        // return $this->model->select($columns)->with( $relations)->findOrFail($id)->append($appends);
    }
 
   
    public function create(array $attributes){

        $model = $this->model->create($attributes);
        return $model->fresh();
    }

    public function update(int $modelId = null, array $attributes){
        
        $modelId = ($modelId == null ) ? $this->model->id : $modelId;
        $model = $this->findById($modelId);
        return $model->update($attributes);
    }

    public function deleteById(int $modelId ){
        return  $this->findById($modelId)->delete();
    }
    public function delete(){
        return  $this->model->delete();
    }

    public function restoreById(int $modelId ){
       
       return $this->allTrashed()->findOrFail($modelId)->restore();
    }

    public function permenentDeleteById(int $modelId ){
        return $this->model->withTrashed()->findOrFail($modelId)->forceDelete;
    }

}
