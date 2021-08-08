<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SimpleUserResource;
use App\Models\User;
use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    
    public function followers(User $user)
    {
        $users = $user->followers()->get();

        return SimpleUserResource::collection($users);
    }

    public function following(User $user)
    {
        $users = $user->following()->get();
        
        return SimpleUserResource::collection($users);
    }

    public function followingTrigger(User $user)
    {
        $auth_user = User::findOrFail( Auth::id() );
        
        $auth_user->hasFollowed($user) ?  $auth_user->unFollow($user) :  $auth_user->follow($user) ;
        $user->notify(new UserFollowNotification($auth_user));
        return response()->json([
            'msg'=> 'you are '.( $auth_user->hasFollowed($user) ? 'following ': 'unfollowing '). $user->name,
        ]);
    }
}
