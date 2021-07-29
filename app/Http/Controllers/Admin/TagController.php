<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\Contracts\TagInterface;

class TagController extends Controller
{
    public $tags ;

    public function __construct(TagInterface $tags)
    {
        $this->tags = $tags;
    }
    
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(Tag $tag)
    {
        //
    }

    
    public function edit(Tag $tag)
    {
        //
    }

   
    public function update(Request $request, Tag $tag)
    {
        //
    }

    
    public function destroy(Tag $tag)
    {
        //
    }

    function get_hashtags($string) {
        
        /* Match hashtags */
    
        preg_match_all('/#(\w+)/', $string, $matches);
    
        
    
        /* Add all matches to array */
    
        foreach ($matches[1] as $match) {
    
        $keywords[] = $match;
    
        }
    
        
    
        return (array) $keywords;
    
    }
}
