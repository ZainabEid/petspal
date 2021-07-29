<?php
namespace App\Repositories\Eloquent;

use App\Models\Comment;
use Exception;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\Contracts\CommentInterface;

class CommentRepository extends BaseRepository implements CommentInterface
{
    protected $model;

    public function __construct(Comment $model)
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
            
            // create comme
            $comment = $post->comments()->create($attributes);


        } catch(\Exception $e)
        {
            DB::rollback();
            return back()->withError($e->getMessage());
        }
        
        DB::commit();
        
        return  $comment->fresh();
    }// end of create funciton


    public function update(int $commentId = null, array $attributes, Post $post=null )
    {
        DB::beginTransaction();

        $comment =""; 

        try {
            
            // create comment
            $commentId = ($commentId == null ) ? $this->model->id : $commentId;

            $comment = $this->findById($commentId);

            $comment->update($attributes);

            
            

        } catch(\Exception $e)
        
        {
            DB::rollback();
            throw  new Exception($e->getMessage());
            return back()->withError($e->getMessage());
        }

        
        DB::commit();
        return  $post;
    }

   
}

