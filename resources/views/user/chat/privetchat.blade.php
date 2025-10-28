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
            <div id="typing-indecator" class="nt-2 text-muted" style="display: none">{{$user->name}} is typing.....</div>
        </div>

        <form class="chat-input-container" id="message-form">
            <div class="chat-input-actions">
                <i class="fas fa-smile"></i>
                <i class="fas fa-paperclip"></i>
            </div>

                <input type="text" class="chat-input"  name="message" id="chat-input" placeholder="Type a message">

                <div class="send-button" id="send-button">
                    <button type="submit" class="chat-input btn-secondary">send</button>

                    <i class="fas fa-microphone"></i>
                </div>


        </form>
    </div>


</div>

<script>

    document.addEventListener('DOMContentLoaded',function(){
        let receiverId={{$user->id}};
        let senderID={{auth()->id()}};
        let chatBox=document.getElementById('chat-messages');

        let messageForm=document.getElementById('message-form')
        let chatInput=document.getElementById('chat-input');
        let typingIndecator=document.getElementById('typing-indecator');

        fetch('/online', {
            method: 'Post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{csrf_token()}}'

            },
        });

        console.log('🔵 تهيئة الشات:', {
            senderID: senderID,
            receiverId: receiverId
        });

        // التأكد من أن Echo متاح
        if (typeof Echo === 'undefined') {
            console.error('❌ Echo غير معرف - تأكد من تضمين app.js');
            return;
        }

        console.log('🎯 محاولة الاشتراك في القناة:', 'chat.' + senderID);

        /*window.Echo.private('chat.' + senderID)
            .listen('SendMessage',(e)=>{
                console.log('kkkkkkk');
            })*/

     /*   window.Echo.private('chat.' + senderID)
            .listen('SendMessage', (e) => {
                console.log('🎉 تم استقبال event بنجاح!', e);
                console.log('📨 بيانات الرسالة:', e.message);

                // إضافة الرسالة إلى الشات
                if(e.message && e.message.receiver_id == senderID) {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message received';
                    messageDiv.innerHTML = `
                    <div class="message-bubble">
                        <div class="message-text">${e.message.message}</div>
                        <div class="message-time">${new Date().toLocaleTimeString()}</div>
                    </div>`;
                    chatBox.appendChild(messageDiv);
                    chatBox.scrollTop = chatBox.scrollHeight;
                    console.log('✅ تم إضافة الرسالة إلى الشات');
                }
            })
            .error((error) => {
                console.error('❌ خطأ في الاشتراك:', error);
            });*/
     /*   window.Echo.private('chat.' + senderID)
            .listenToAll((event, data) => {
                console.log('🔍 جميع الأحداث في القناة:', event, data);
            });*/
    /*    window.Echo.private('chat.' + senderID)
            .listen('.SendMessage', (e) => { // إضافة النقطة في البداية
                console.log('🎉 تم استقبال الرسالة بنجاح!', e);

                // إضافة الرسالة إلى الشات
                if(e.message && e.message.receiver_id == senderID) {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message received';
                    messageDiv.innerHTML = `
                <div class="message-bubble">
                    <div class="message-text">${e.message.message}</div>
                    <div class="message-time">${new Date(e.message.created_at).toLocaleTimeString()}</div>
                </div>`;
                    chatBox.appendChild(messageDiv);
                    chatBox.scrollTop = chatBox.scrollHeight;
                    console.log('✅ تم إضافة الرسالة إلى الشات');
                }
            });*/

        window.Echo.private('chat.' + senderID)
            .listenToAll((eventName, data) => {
                console.log('🔍 event name:', eventName);
                console.log('📊 event data:', data);

                if (eventName === 'SendMessage') {
                    console.log('🎯 هذا هو الevent المطلوب!');
                    // معالجة البيانات من هنا
                    if (data.message) {
                        const messageDiv = document.createElement('div');
                        messageDiv.className = 'message received';
                        messageDiv.innerHTML = `
                    <div class="message-bubble">
                        <div class="message-text">${data.message.message}</div>
                        <div class="message-time">${new Date().toLocaleTimeString()}</div>
                    </div>`;
                        chatBox.appendChild(messageDiv);
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }
                }
            });



        console.log('✅ تم الاشتراك في القناة بنجاح');


        messageForm.addEventListener('submit',function(e){
            console.log('fffff');
            e.preventDefault();
            const message=chatInput.value;
            if(message){
                fetch(`/privet_chat/${receiverId}/send`, {
                    method: 'Post',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{csrf_token()}}'

                    },
                    body: JSON.stringify({message: message})
                });
                const messagediv=document.createElement('div');
                messagediv.className='messagesent';
                messagediv.innerHTML=` <div class="message-bubble">
                        <div class="message-text">${message}</div>
                    </div>`;
                chatBox.appendChild(messagediv);
                chatBox.scrollTop=chatBox.scrollHeight;
                chatInput.value='';

            }
        });




    });
</script>
</body>
</html>
