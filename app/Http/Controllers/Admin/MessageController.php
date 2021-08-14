<?php

namespace App\Http\Controllers\Admin;

use App\Events\Message;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message as ModelsMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Conversation $conversation,Request $request)
    {
        // dd('store in db');
       $message =  $conversation->messages()->create([
            'sender_id' => auth()->guard('admin')->id(),
            'reciever_id' => $conversation->talked_admin->id,
            'message_content' => $request->message,
            'message_type' => 'text'
        ]);

        // event( new Message($message));
        return ['success'=>true]; 
    }
}
