<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostThumbnailResource;
use App\Http\Resources\TimelinePostResource;
use App\Repositories\Eloquent\Contracts\CommentInterface;
use App\Repositories\Eloquent\Contracts\PostInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public $posts ;
    public $comments ;

    public function __construct(PostInterface $posts ,CommentInterface $comments)
    {
        $this->posts = $posts;
        $this->comments = $comments;
    }
   
    public function index(User $user)
    {
        $posts_images = $user->posts()->get();
        return PostThumbnailResource::collection( $posts_images);
    }

    public function store(User $user , PostRequest $request)
    {
        $post = $this->posts->create($request->all() , $user);
        return new PostResource( $post);
    }

   
    public function show(User $user , Post $post)
    {
        $post = $this->posts->findById($post->id);
        return new PostResource( $post);
    }

  
    public function update(User $user, PostRequest $request, Post $post)
    {
        $post = $this->posts->update($post->id , $request->all() , $user);
        return new PostResource( $post);
    }

    
    public function destroy(User $user , Post $post)
    {

        if(Auth::id() !== $user->id) {

            throw new AuthorizationException("You don't have the authority to delete this post", 403);
        }
      

        $this->posts->deleteById($post->id);

        return response()->json([
            'msg' => 'post is deleted'
        ]);
       
    }

    
}
