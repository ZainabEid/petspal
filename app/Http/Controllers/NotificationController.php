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

    public function notifications()
    {
        $user = User::findOrFail(Auth::id());
       
        return NotificationResource::collection($user->notifications);
    }


    // mark as read
    public function readAllNotifications()
    {
        $user = User::findOrFail(Auth::id());
        $user->unreadNotifications->markAsRead();

        return NotificationResource::collection($user->notifications);

    }

    
    public function updateToken(Request $request)
    {
        $auth_user = User::findOrFail(Auth::id());

        $auth_user->update([
            // 'device_id' => $request->device_id,
            'device_token' => $request->device_token
        ]);

        return response()->json([
            "msg" => "token updated", 
            ]);
            
    }
     

   

    public function sendUserFollowNotification(User $user)
    {
        $auth_user = User::findOrFail(Auth::id());

        Notification::send( $user, new UserFollowNotification($auth_user) );

        $device_token = User::whereNotNull('device_token')->pluck('device_token')->toArray();

        if(! $device_token){
            return response()->json([
                "error" => "please update device token", 
                ]);
        }
   
        return $this->sendNotification('APA91bEtSX9AHnS', [
            "title" => "User Follow Notification", 
            "body" => $user->name."follows you",
            ]
        );
    }


   
   
    public function sendNotification($device_token, $message)
    {
        $SERVER_API_KEY = env( 'FIREBASE_API_KEY','' );

        // payload data, it will vary according to requirement
        $data = [
            "to" => $device_token, // for single device id
            "data" => $message
        ];

        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
        curl_close($ch);
      
        return $response;
    }

}
