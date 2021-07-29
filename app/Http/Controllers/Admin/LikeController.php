<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function like(User $user , Post $post)
    {
        $user->like($post);
        return redirect()->back();
    }

    public function unLike(User $user , Post $post)
    {
        $user->unlike($post);
        return redirect()->back();
    }
}
