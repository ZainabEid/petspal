<?php
namespace App\Repositories\Eloquent\Contracts;


interface EloquentInterface
{
   public function all(array $columns =['*'] , array $relations = [] );
   public function allPaginated( int $pagination=10 );
   public function allTrashed();
   public function findById(int $id , array $columns =['*'] , array $relations = [],  array $appends = [] );

  
   public function create(array $attributes);
   public function update(int $modelId , array $attributes);
   public function delete();
   public function deleteById(int $modelId );
   public function restoreById(int $modelId );
   public function permenentDeleteById(int $modelId );

   

}