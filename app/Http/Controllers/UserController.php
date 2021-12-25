<?php

namespace App\Http\Controllers;

use App\Chatroom;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function searchFriend(Request $request)
    {
        $keyword = $request->keyword;
        $id = $request->user_id;
        $list_friend = User::where('name','like','%'.$keyword.'%')
                        ->where('id','<>',$id)->get();
        return view('chats.list_friend')->with('list_friend',$list_friend);
    }
    public function searchUser(Request $request)
    {
        $keyword = $request->keyword;
        $room_id = $request->room_id;
        $room = Chatroom::find($room_id);
        if(empty($room) || $room->type != 'group_chat')
            return null;
        $list_user = User::where('name','like','%'.$keyword.'%')->whereNotExists(function ($query) use($room_id){
                            $query->select('user_id')
                                ->from('detail_chatrooms')
                                ->where('detail_chatrooms.room_id',$room_id)
                                ->whereRaw('detail_chatrooms.user_id = users.id');   
                        })->get();
        
        $data = null;
        foreach($list_user as $user){
            $url = '/add-member-room?user_id='.$user->id.'&room_id='.$room_id;
            $data .= '<a href="'.$url.'">'.$user->name.'</a>';
        }
        return $data;
    }
}
