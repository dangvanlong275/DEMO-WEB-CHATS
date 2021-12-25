<?php

namespace App\Http\Controllers;

use App\Chatroom;
use App\DetailChatroom;
use App\Message;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatroomController extends Controller
{
    public function indexChat(Request $request)
    {
        $list_friend = User::where('id','<>',Auth::id())->get();
        $user = Auth::user();
        $list_friend = User::where('id','<>',$user->id)->get();
        $list_dt_group = DetailChatroom::whereHas('chatRoom', function ($query){
                                    $query->where('user_id',Auth::id());
                                    $query->where('chatrooms.type','group_chat');
                                    return $query;
                                })->get(); 
        
        //lấy danh sách group của user
        $list_group = [];
        foreach($list_dt_group as $dt_group){
            $list_group[] = Chatroom::find($dt_group->room_id);
        }
        return view("chats.indexchat",compact('list_friend','list_group','user','list_friend'));
    }
    public function index(Request $request)
    {
        $room_id = $request->id;
        $user = Auth::user();
        $room = Chatroom::find($room_id);
        $admin_room = User::find($room->creator);

        //kiểm tra user đã được thêm vào phòng hay chưa
        $users_room = DetailChatroom::with('user')->where(function ($query) use($room_id){
                                        $query->where('room_id',$room_id);
                                        })->get(); 
                                        
        $existsUserRoom = $users_room->where('user_id',$user->id)->first();
        if(empty($existsUserRoom))
            return redirect('/index');

        if($room->type == Chatroom::ROOM_TYPE['private']){
            $user_room = $room->members()
                        ->where('users.id','<>',$user->id)->first();
            $room_name = $user_room->name;
        }else{
            $room_name = $room->name;
        }
        //lấy danh sách bạn bè
        $list_friend = User::where('id','<>',$user->id)->get();

        $list_dt_group = DetailChatroom::whereHas('chatRoom', function ($query){
                                    $query->where('user_id',Auth::id());
                                    $query->where('chatrooms.type','group_chat');
                                    return $query;
                                })->get(); 
        
        //lấy danh sách group của user
        $list_group = [];
        foreach($list_dt_group as $dt_group){
            $list_group[] = Chatroom::find($dt_group->room_id);
        }

        $messages = Message::where("room_id",$room_id)->get();

        return view("chats.index",compact('room','user', 'room_name','list_friend','list_group','messages','users_room'));
    }

    public function createChatRoom(Request $request)
    {
            $user_id_1 = Auth::id();
            $user_id_2 = $request->user_id;
            $user_1 = DetailChatroom::where('user_id',$user_id_1)->with('chatRoom')->get(); 
            //kiểm tra phòng chat đã tồn tại hay chưa
            foreach($user_1 as $room){
                if($room->chatRoom->type == Chatroom::ROOM_TYPE['private']){
                    $user_2 = DetailChatroom::where('user_id',$user_id_2)->where('room_id',$room->chatRoom->id)->first();
                    if(!empty($user_2))
                        return redirect('room/'.$user_2->room_id);
                }
            }
            // thực hiện tạo phòng
            $data['type'] = $request->type;
            $data['creator'] = $user_id_1;
            $chatroom = Chatroom::create($data);
            //Thêm user 1 vào phòng
            $dt_chatroom['user_id'] = $user_id_1;   

            $dt_chatroom['room_id'] = $chatroom->id;

            DetailChatroom::create($dt_chatroom);
            //Thêm user 2 vào phòng
            $dt_chatroom['user_id'] = $user_id_2;

            DetailChatroom::create($dt_chatroom);

            return redirect('room/'.$chatroom->id);
    }

    public function createGroupChatRoom(Request $request)
    {
        //Tạo nhóm chat
        $data['type'] = $request->type;
        $data['name'] = $request->name;
        $data['creator'] = Auth::user()->id;
        $chatroom = Chatroom::create($data);
        //Thêm user vào phòng
        $dt_chatroom['user_id'] = Auth::id();
        $dt_chatroom['room_id'] = $chatroom->id;
        DetailChatroom::create($dt_chatroom);

        return redirect('room/'.$chatroom->id);
    }

    public function addMemberRoom(Request $request)
    {
        $data['user_id'] = $request->user_id;
        $data['room_id'] = $request->room_id;
        DetailChatroom::create($data);
        return redirect()->back();
    }

    public function deleteMember(Request $request)
    {
        $user_id = $request->user_id;
        $room_id = $request->room_id;
        $detail_room = DetailChatroom::where('user_id',$user_id)    
                                    ->where('room_id',$room_id);

        if(empty($detail_room))
            return redirect('/index');

        $detail_room->delete();
        
        return redirect()->back();
    }
}
