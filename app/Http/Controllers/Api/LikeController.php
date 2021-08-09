<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Likeable;
use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostLikesResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Notifications\UserLikedPostNotification;

class LikeController extends Controller
{
    public function likePost(Post $post)
    {
      $post->author->notify(new UserLikedPostNotification(Auth::user(),$post ));

      return new PostResource($post->like());
    }

    public function likeComment(Comment $comment)
    {
       return new CommentResource( $comment->like());
    }

  

   
}
