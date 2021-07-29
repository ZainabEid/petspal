<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
   

    public function index()
    {
        //
    }

    public function create(User $user)
    {
        return view('admin.users.posts.create',compact('user'));
    }

  
    
    public function store(User $user , Request $request)
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
       
        $users = User::all();
        $comments = $this->comments->paginateFive($post);
        $post->body = $this->hashtag_links($post->body);
        
        return view('admin.users.posts.show',compact('post','users','comments'));

    }

    public function changeUser()
    {
        $user = request()->user_id;
        return $user;
    }

    function hashtag_links($string) {
        preg_match_all('/#(\w+)/', $string, $matches);
        if($matches){
            if(array_key_exists(0, $matches)){
                $array = $matches[0];
                foreach ($array as $key => $match) {
                    // $route = route('admin.tags.show',$match);
                    $route = $match;
                    $string= str_replace("$match" ,"<a class='text-danger' href='$route'>$match</a>", $string);
                }
            }
        }
        return $string;
    }

   
    public function edit(Post $post)
    {
        //
    }

   
    public function update(Request $request, Post $post)
    {
        //
    }

    
    public function destroy(Post $post)
    {
        //
    }

    
}
