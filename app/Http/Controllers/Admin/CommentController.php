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

   
    public function edit(Post $post , Comment $comment)
    {
        return  view('admin.users.posts.comments.edit',compact('post', 'comment'));
    }

    
    public function update(Post $post, Comment $comment,Request $request)
    {
        // $request->validate([
        //     'body' => 'nullable|string',
        // ]);
       

        $comment = $this->comments->update($comment->id , $request->all() , $post);

        return redirect()->route('admin.users.posts.show',[$post->author->id , $post->id]);
    }

   
    public function destroy(Post $post , Comment $comment)
    {
        $this->comments->deleteById($comment->id);

        session()->flash('success', __('deleted-successfuly'));

        return redirect()->route('admin.users.posts.show',[ $post->author->id ,  $post->id]);
    }
}
