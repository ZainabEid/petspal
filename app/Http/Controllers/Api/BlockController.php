<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SimpleUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    public function blockList()
    {
        $auth_user = User::findOrFail( Auth::id() );
        $users = $auth_user->blocks()->get();

        return SimpleUserResource::collection( $users);
    }

    public function block(User $user)
    {
        if(Auth::id() == $user->id){
            return response()->json([
                'error' => 'you can\'t block yourselef'
            ]);
        }
        $auth_user = User::findOrFail( Auth::id() );
        
        $auth_user->block($user) ;
        
        return response()->json([
            'msg'=> 'you have blocked '. $user->name,
        ]);
    }


    public function unblock(User $user)
    {
        if(Auth::id() == $user->id){
            return response()->json([
                'error' => 'you can\'t do this action'
            ]);
        }
        $auth_user = User::findOrFail( Auth::id() );
        
        $auth_user->unBlock($user);
        
        return response()->json([
            'msg'=> 'you have unblocked '. $user->name,
        ]);
    }
}
