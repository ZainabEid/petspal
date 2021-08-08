<?php
namespace App\Repositories\Eloquent\Contracts;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Eloquent\Contracts\EloquentInterface;

interface CommentInterface extends EloquentInterface
{
    public function __construct(Comment $admin);
    public function paginateFive( Post $post);
    public function createComment(array $attributes , Post $post);
    public function update(int $commentId = null, array $attributes);
   

}