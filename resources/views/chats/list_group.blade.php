<ul class="contacts">
    @foreach ($list_group as $group)
        <li class="active">
            <i class="fas fa-users"></i>
            <a class="user_info" href="/room/{{$group->id}}">
                <span>{{$group->name}}</span>
            </a>
        </li>
    @endforeach
</ul>