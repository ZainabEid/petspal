<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    
    public function __construct()
    {
       
    }
      
    public function index()
    {
    
        $posts = Post::latest()->paginate(5);

        return PostResource::collection( $posts);
        
    } // end of index

} // end of controller
