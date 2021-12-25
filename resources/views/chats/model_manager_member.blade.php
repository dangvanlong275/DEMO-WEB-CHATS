
            <span id="action_menu_btn">
                <i class="fas fa-ellipsis-v"></i>
            </span>
            <div class="action_menu p-2">
                <ul class="p-2" style="background-color: rgba(0, 0, 0, 0.3); border-radius: 15px;">
                    <span data-toggle="modal" data-target="#addMemeberModal" style="cursor: pointer;">
                        <i class="fas fa-user-plus"></i> Thêm thành viên 
                    </span>
                </ul>
                <ul id="member_group">
                  @foreach ($users_room as $user)
                      <li id="user_{{ $user->user->id }}" class="d-flex justify-content-sm-between align-items-center dropright">
                        <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-users"></i>{{ $user->user->name }}
                        </span>
                        @if (Auth::id() == $room->creator)
                          <label for="remove_member_{{$user->user->id}}" class="dropdown-menu">
                            Remove
                        </label>
                        <form id="form_remove_member" action="{{ route('delete_member') }}" method="post" enctype="multipart/form-data" hidden>
                          @csrf
                          <input type="hidden" name="user_id" value="{{$user->user->id}}">
                          <input type="hidden" name="room_id" value="{{ $room->id }}">
                          <input type="submit" value="submit" hidden id="remove_member_{{$user->user->id}}">
                        </form>
                        @endif
                      </li>
                  @endforeach
              </ul>
            </div>
            <div class="modal fade" id="addMemeberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content" style="background: cadetblue">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><b>Add Members To The Room</b></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('room_group') }}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="type" value="group_chat">
                            <div class="form-group dropdown-add-member">
                                <label for="add_member"><b>Member Name</b></label>
                                <input type="search" class="form-control" name="name" id="add_member">
                                <div id="seach_add_member">
                                    
                                </div>
                            </div>
                            <input type="submit" value="submit" hidden id="create_group_chat">
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
            </div>