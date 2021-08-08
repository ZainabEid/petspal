<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    
    public function index()
    {
        $tags = Tag::all();
        return TagResource::collection($tags);
    }

    public function show(Tag $tag)
    {
        $posts =  $tag->posts;
        return  PostResource::collection($posts);
    }

  
}
