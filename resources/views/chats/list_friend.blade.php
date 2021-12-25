<ul class="contacts">
    @foreach ($list_friend as $user)
        <li class="active">
            <form action="{{ route('room_private') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="submit_private{{$user->id }}" class="d-flex bd-highlight align-items-center" style="cursor: pointer;">
                <div class="img_cont">
                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                        class="rounded-circle user_img">
                    <span class="online_icon"></span>
                </div>
                <div class="user_info">
                    <span>{{$user->name}}</span>
                </div>
                </label>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="type" value="private">
                <input type="submit" value="submit" hidden id="submit_private{{$user->id }}">
            </form>
        </li>
    @endforeach
</ul>