@extends('chats.indexchat')
@section('content_message')
<input type="hidden" name="room_type" id="room_type" value="{{ $room->type }}">
<div class="col-md-8 col-xl-6 chat">
    <div class="card">
        <div class="card-header msg_head">
            <div class="d-flex bd-highlight align-items-center">
                <div class="img_cont">
                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                        class="rounded-circle user_img">
                    <span class="online_icon"></span>
                </div>
                <div class="user_info">
                    <span>{{$room_name}}</span>
                </div>
                <div class="video_cam">
                    <span><i class="fas fa-video"></i></span>
                    <span><i class="fas fa-phone"></i></span>
                </div>
            </div>
            @if ($room->type == 'group_chat')
                @include('chats.model_manager_member')
            @endif
        </div>
        <div class="card-body msg_card_body">
            <div id="content">
                @foreach ($messages as $message)
                    @if($message->sender == Auth::id())
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send" title="{{date('H:i', strtotime($message->created_at))}}">
                            {{$message->content}}
                        </div>
                        <div class="img_cont_msg">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    @else
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer" title="{{date('H:i', strtotime($message->created_at))}}">
                            {{$message->content}}
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        
        <div class="card-footer">
            
            <span id="notifi_text">long dang nhắn tin</span>
            <div class="input-group justify-content-end" >
                <form id="message_form">
                    <input type="hidden" id="user_name" value="{{$user->name}}">
                    <input type="hidden" name="room" id="room_input" value="{{$room->id}}">
                    <input id="content_input" name="content" class="form-control type_msg" placeholder="Type your message...">
                    <input type="submit" id="send_message" style="display: none">
                    <div class="input-group-append">
                    </div>
                </form>
                <label for="send_message" class="input-group-text send_btn">
                    Send
                </label>
            </div>
        </div>
    </div>
</div>
@endsection