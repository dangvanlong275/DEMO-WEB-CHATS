<style>
    #logout{
        display: none;
    }
    #logout input{
        border: 0;
        background: lightblue;
        opacity: 100%; 
        z-index: 10;
    }
    #nav-user:checked + #logout{
        display: block;
    }
</style>
<div class="col-md-4 col-xl-3 chat">
        <div class="card mb-sm-3 mb-md-0 contacts_card"><div class="card-body ">
                <div>
                    <a class="d-flex bd-highlight align-items-center">
                        <div class="img_cont">
                            <label for="nav-user" style="cursor: pointer;">
                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img">
                                <span class="online_icon"></span>
                                <input type="hidden" name="" id="user_id" value="{{$user->id}}">
                            </label>
                            <input type="checkbox" hidden id="nav-user">
                            <div id="logout" >
                                <form action="/logout" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input class="pull-right" type="submit" value="Logout">
                                </form>
                            </div>
                        </div>
                        <div class="user_info">
                            <span>{{$user->name}}</span>
                        </div>
                        <div class="ml-auto p-2" >
                            <span data-toggle="modal" data-target="#createGroupChatModal" style="font-size:x-large; color:white; cursor: pointer;">
                                <i class="far fa-plus-square"></i>
                            </span>
                            <div class="modal fade" id="createGroupChatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content" style="background: cadetblue">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"><b>Create Group Chat</b></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body ">
                                        <form action="{{ route('room_group') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="type" value="group_chat">
                                            <div class="form-group">
                                                <label for="name_group"><b>Group Name</b></label>
                                                <input type="text" class="form-control" name="name" id="name_group">
                                            </div>
                                            <input type="submit" value="submit" hidden id="create_group_chat">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <label for="create_group_chat" type="button" class="btn btn-primary" style="background: #d86b1d;">Save</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </a>
                </div>
                
                <div class="card-header mt-3" style="margin-bottom: 100%">
                    <div class="input-group">
                        <input type="search" id="search_user" placeholder="Search..." class="form-control search">
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-body contacts_body" >
            <h4 class="ml-3 "><b style="color: white">Group Chats</b></h4>
            <div id="list_group" >
                @include('chats.list_group')
            </div>
            <h4 class="ml-3"><b style="color: white">Friends</b></h4>
            <div id="list_user">
                @include('chats.list_friend')
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
</div>