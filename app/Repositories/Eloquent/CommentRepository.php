<?php
namespace App\Repositories\Eloquent;

use Exception;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\Contracts\CommentInterface;

class CommentRepository extends BaseRepository implements CommentInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model =  $model;   
        
    }// end of constructor

    public function paginateFive( Post $post)
    {
        return $post->comments()->paginate(5);
        
    }// end of constructor

    
    public function create(array $attributes, Post $post=null )
    {
        DB::beginTransaction();

        // $post =""; 

        try {
            
            // create post
            $post = $post->comments()->create($attributes);


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

            $post->comments->update($attributes);

            
            

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

