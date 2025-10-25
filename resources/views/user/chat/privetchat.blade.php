<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Clone</title>
    <link href="{{ asset('assets/css/chat.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body>
<div id="app">
    <!-- Users List Page -->
    <!-- Chat Page -->

    <div id="chat-page" class="page active">
        <div class="chat-header">
            <div class="back-button" id="back-button">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="chat-user-info">
                <img src="" alt="" class="avatar" id="chat-user-avatar">
                <div class="chat-user-details">
                    <span class="chat-user-name" id="chat-user-name"></span>
                    <span class="chat-user-status" id="chat-user-status">online</span>
                </div>
            </div>
            <div class="chat-actions">
                <i class="fas fa-video"></i>
                <i class="fas fa-phone"></i>
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>

        <div class="chat-messages" id="chat-messages">
            @foreach($messages as $message)
                <di class="message  {{$message->sender_id ? 'sent' : 'received'}}">
                    <div class="message-bubble">
                        <div class="message-text">{{$message->message}}</div>
                        <div class="message-time">{{$message->created_at}}</div>
                    </div>
                </di>
            @endforeach
        </div>

        <form class="chat-input-container">
            <div class="chat-input-actions">
                <i class="fas fa-smile"></i>
                <i class="fas fa-paperclip"></i>
            </div>

                <input type="text" class="chat-input" id="chat-input" placeholder="Type a message">

                <div class="send-button" id="send-button">
                    <button type="submit" class="chat-input btn-secondary">send</button>

                    <i class="fas fa-microphone"></i>
                </div>


        </form>
    </div>


</div>

<script src="{{ asset('assets/js/js.js') }}"></script>
</body>
</html>
