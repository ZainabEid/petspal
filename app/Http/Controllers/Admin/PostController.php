<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use App\Repositories\Eloquent\Contracts\CommentInterface;
use App\Repositories\Eloquent\Contracts\PostInterface;

class PostController extends Controller
{
    public $posts ;
    public $comments ;

    public function __construct(PostInterface $posts ,CommentInterface $comments)
    {
        $this->posts = $posts;
        $this->comments = $comments;
    }
   

    public function index(Request $request)
    {
        $tags = Tag::all();
        if ($request->ajax()) {

            dd($request->all());

            if($request->tag ){
                
                $posts = Post::with('tags')->where('tag_name',$request->tag)->paginate(5);
                
                return view('admin.users.accounts._posts_rows',compact('posts'));
            }

            $posts = Post::paginate(5);

            return view('admin.users.accounts._posts_rows',compact('posts')) ;
        }

        return view('admin.users.posts.index',compact('tags'));
    }

    public function create(User $user)
    {
        return view('admin.users.posts.create',compact('user'));
    }

  
    
    public function store(User $user , PostRequest $request)
    {
        
        $request->validate([
            'body' => 'nullable|string',
            'medias' => 'required|array|min:1',
            // 'medias.*' => 'mimetypes:image,video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ]);
       

        $post = $this->posts->create($request->all() , $user);

        return redirect()->route('admin.users.accounts.show',[$user->id , $user->account()->id]);

    }

   
    public function show(User $user , Post $post)
    {
       
        $users = User::all(); // for creating  new post
        $comments = $this->comments->paginateFive($post);
        
        return view('admin.users.posts.show',compact('post','users','comments'));

    }

    public function changeUser()
    {
        $user = request()->user_id;
        return $user;
    }

  
   
    public function edit(User $user, Post $post)
    {
        return view('admin.users.posts.edit',compact('user','post'));
    }

   
    public function update(User $user, PostRequest $request, Post $post)
    {
       
        $post = $this->posts->update($post->id , $request->all() , $user);

        return redirect()->route('admin.users.accounts.show',[$user->id , $user->account()->id]);
    }

    
    public function destroy(User $user , Post $post)
    {
        $this->posts->deleteById($post->id);

        session()->flash('success', __('deleted-successfuly'));

        return redirect()->route('admin.users.accounts.show',[ $user->id ,  $user->account()->id]);
      
    }

    
}
