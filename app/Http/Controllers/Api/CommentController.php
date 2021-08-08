<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\User;
use App\Repositories\Eloquent\commentRepository;
use App\Repositories\Eloquent\Contracts\CommentInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public $comments ;

    public function __construct(CommentInterface $comments)
    {
        $this->comments = $comments;
    }
    
    public function index(Post $post)
    {
        $comments = $this->comments->paginateFive($post);
        return CommentResource::collection( $comments);
    }

 
    public function store(Post $post, CommentRequest $request)
    {
        
        $comment = $this->comments->createComment($request->all() ,  $post);

        if(! $comment){

            return response()->json([
                'error' => 'can\'t create comment, something went wrong !'
            ]);
            
        }
        
        return new CommentResource($comment);
    }

    

    public function update(Post $post, Comment $comment,CommentRequest $request)
    {
       
        $comment = $this->comments->update($comment->id , $request->all() );

        if(! $comment){

            return response()->json([
                'error' => 'can\'t create comment, something went wrong !'
            ]);
            
        }
        
        return new CommentResource($comment);
    }

   
    public function destroy(Post $post , Comment $comment)
    {
        
        if(Auth::id() !== $comment->author->id) {
            
            throw new AuthorizationException("You don't have the authority to delete this comment", 403);
        }
        
        
        $result = $this->comments->deleteById($comment->id);
        if(!$result){
            return response()->json([ 'error' => 'something went wrong' ]);
        }

       
        return response()->json([
            'msg' => 'Comment is deleted',
        ]);
    }
}
