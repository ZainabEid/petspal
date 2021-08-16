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
       $message =  $conversation->messages()->create([
            'sender_id' => auth()->guard('admin')->id(),
            'reciever_id' => $conversation->talked_admin->id,
            'message_content' => $request->message,
            'message_type' => 'text'
        ]);

        event( new Message($message));
        return view('admin.conversations._message',compact( 'message')); 
    }

    public function show(Conversation $conversation, ModelsMessage $message)
    {
        if (request()->expectsJson()) {
            return view('admin.conversations._message',compact( 'message')); 
        }
        return view('admin.conversations._message',compact( 'message')); 
    }
}
