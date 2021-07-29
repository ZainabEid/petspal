<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Eloquent\commentRepository;
use App\Repositories\Eloquent\Contracts\CommentInterface;

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
      return view('admin.users.posts._comments',compact('comments'));
    }

    
    public function create()
    {
        $users = User::all();
        return view('admin.posts.comments.create',compact('users'));
    }

 
    public function store(Post $post,Request $request)
    {

        $this->comments->create($request->all() ,  $post);
        return redirect()->back();
    }

    
    public function show(Comment $comment)
    {
        //
    }

   
    public function edit(Comment $comment)
    {
        //
    }

    
    public function update(Request $request, Comment $comment)
    {
        //
    }

   
    public function destroy(Comment $comment)
    {
        //
    }
}
