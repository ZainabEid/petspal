<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\User;
use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function sendUserFollowNotification(User $user)
    {
        $auth_user= User::findOrFail(Auth::id());
        Notification::send($auth_user, new UserFollowNotification($user));
   
        dd('Task completed!');
    }
     
    public function notifications(User $user	)
    {
        return NotificationResource::collection($user->notifications);
    }
}
