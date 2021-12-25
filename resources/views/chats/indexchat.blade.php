
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chats</title>
    @include('chats.headers')
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            @include('chats.nav_user')
            @yield('content_message')
        </div>
    </div>
    
    <div id="app"></div>
</body>
<script src="http://localhost:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{asset("js/chat.js")}}"></script>
<script src="{{asset("js/app.js")}}"></script>
<script src="{{asset("js/handle_user.js")}}"></script>
</html>