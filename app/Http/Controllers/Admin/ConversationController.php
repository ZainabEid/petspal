<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index(Request $request)
    {

        if ( $request->expectsJson() ) {

            // handle when conversation is selected
            if($request->conversation_id){

                $conversation = Conversation::findOrFail($request->conversation_id);
                return view('admin.conversations._conversation',compact('conversation'));
            }

            return response()->json([ 'error' => 'there is no conversation_id' ]);
        }


        // conversations where auth_admin is one of talker
        $conversations = Conversation::where('admin_id' , Auth::guard('admin')->id())
                            ->orWhere('to_admin_id' , Auth::guard('admin')->id())->get();

                            // dd( $conversations );
        return view('admin.conversations.index', compact('conversations'));
    }

    public function create()
    {
        // all admins who dont have conversation with auth_admin()
        // $admins = Admin::whereDoesntHave('conversations')->get();

        $admins = Admin::all();

        return view('admin.conversations.create',compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'selected_user_id' => [
                'required',
                Rule::unique('conversations','admin_id')->where('to_admin_id',  Auth::guard('admin')->id()),
                Rule::unique('conversations','to_admin_id')->where('admin_id',  Auth::guard('admin')->id()),
            ],
        ]);

        Conversation::create([
            // 'cannel_name' =>  'PrivateChat',
            'admin_id' => Auth::guard('admin')->id(),
            'to_admin_id' => $request->selected_user_id,
        ]);

        return redirect()->route('admin.conversations.index');
    }

    public function show(Request $request, Conversation $conversation)
    {
        if ( $request->expectsJson() ) {

            
            if($conversation->messages()->count() > 0){

                $messages = $conversation->messages()->paginate(10);
                return view('admin.conversations._messages',compact('messages'));
            }

            return response()->json([ 'error' => 'there is no messages' ]);
        }
    }
}
