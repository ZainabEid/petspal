<?php
namespace App\Repositories\Eloquent;

use Exception;
use App\Models\Post;
use App\Repositories\Eloquent\Contracts\TagInterface;
use Illuminate\Support\Facades\DB;

class TagRepository extends BaseRepository implements TagInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

    
    public function FirstOrcreate(array $attributes, Post $post=null )
    {
        DB::beginTransaction();

        // $post =""; 

        try {
            
            // create post
            $post = $post->tags()->firstOrCreate($attributes);


        } catch(\Exception $e)
        {
            DB::rollback();
            return back()->withError($e->getMessage());
        }
        
        DB::commit();
        
        return  $post->fresh();
    }// end of create funciton


    public function update(int $postId = null, array $attributes, Post $post=null )
    {
        DB::beginTransaction();

        $post =""; 

        try {
            
            // create post
            $postId = ($postId == null ) ? $this->model->id : $postId;

            $post = $this->findById($postId);

            $post->tags->update($attributes);

            
            

        } catch(\Exception $e)
        
        {
            DB::rollback();
            throw  new Exception($e->getMessage());
            return back()->withError($e->getMessage());
        }

        
        DB::commit();
        return  $post;
    }

    // use Spatie\Permission\Traits\HasRole   in Post post 
    public function assignRole($roles)
    { 
        return $this->model->assignRole($roles);
    }
}

