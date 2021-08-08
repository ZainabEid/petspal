<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __call($method,$arameters)
    {
        $page = Page::where('page->en' ,$method)->first();
        return new PageResource($page);
    }
}
