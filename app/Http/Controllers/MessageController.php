<?php

namespace App\Http\Controllers;

use App\Chatroom;
use App\Events\ChatPrivate;
use App\Events\Chats;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    
    public function store(Request $request){
        $data['room_id'] = $request->room;
        $data['sender'] = Auth::id();
        $data['content'] = $request->content;
        $message = Message::create($data);
        $room = Chatroom::find($data['room_id']);
        if($room->type == 'group_chat')
            broadcast(new Chats($message->load('sender')))->toOthers();
        else
            broadcast(new ChatPrivate($message->load('sender')))->toOthers();
            
        return response()->json(['message' => $message->load('sender')]);
    }

}
