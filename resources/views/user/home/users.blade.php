<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Clone</title>
    <link href="{{ asset('assets/css/chat.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <!-- Users List Page -->
    <div id="users-page" class="page active">
        <div class="header">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=You&background=25D366&color=fff" alt="{{$user->name}}" class="avatar">
                <span class="user-name">{{$user->name}}</span>
            </div>
            <div class="header-actions">
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>

        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="search-input" placeholder="Search or start new chat">
            </div>
        </div>

        <div class="users-list" id="users-list">
            @foreach($users as $user)
                <a href="{{route('privet_chat',$user->id)}}">
                    <div class="user-item">
                        <img  src="https://ui-avatars.com/api/?name=You&background=25D366&color=fff"  alt="{{$user->name}}" class="avatar">
                        <div class="user-details">
                            <div class="user-item-name">{{$user->name}}</div>
                            <div class="user-item-last-message"> {{$user->lastMessage($user)}}</div>
                        </div>
                    </div>
                </a>


            @endforeach
            <!-- Users will be populated by JavaScript -->
        </div>

        <div class="fab">
            <i class="fas fa-comment"></i>
        </div>
    </div>


</div>

</body>
</html>
