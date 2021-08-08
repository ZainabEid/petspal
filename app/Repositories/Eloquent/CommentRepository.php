<?php
namespace App\Repositories\Eloquent;

use App\Models\Comment;
use Exception;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\Contracts\CommentInterface;
use Illuminate\Support\Facades\Auth;

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

    
    public function createComment(array $attributes, Post $post )
    {
        DB::beginTransaction();

        $comment =""; 

        try {

            $attributes['user_id'] = Auth::id() ?:  $attributes['user_id'];

            // create comment
            $comment = $post->comments()->create($attributes);


        } catch(\Exception $e)
        {
            DB::rollback();
            
            report($e);

            return false;
        }
        
        DB::commit();
        return  $comment->fresh();
    }// end of create funciton


    public function update(int $commentId = null, array $attributes )
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
            
            report($e);

            return false;
        }

        
        DB::commit();
        return   $comment;
    }

   
}

