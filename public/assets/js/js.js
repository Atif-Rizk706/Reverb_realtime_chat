// Sample users data
const users = [
    {
        id: 1,
        name: "John Doe",
        avatar: "https://ui-avatars.com/api/?name=John+Doe&background=128C7E&color=fff",
        lastMessage: "Hey, how are you doing?",
        time: "10:30 AM",
        unread: 2,
        online: true
    },
    {
        id: 2,
        name: "Sarah Smith",
        avatar: "https://ui-avatars.com/api/?name=Sarah+Smith&background=25D366&color=fff",
        lastMessage: "Let's meet tomorrow",
        time: "Yesterday",
        unread: 0,
        online: true
    },
    {
        id: 3,
        name: "Mike Johnson",
        avatar: "https://ui-avatars.com/api/?name=Mike+Johnson&background=128C7E&color=fff",
        lastMessage: "Thanks for your help!",
        time: "Yesterday",
        unread: 1,
        online: false
    },
    {
        id: 4,
        name: "Emily Brown",
        avatar: "https://ui-avatars.com/api/?name=Emily+Brown&background=25D366&color=fff",
        lastMessage: "Did you see the new movie?",
        time: "12/15/23",
        unread: 0,
        online: true
    },
    {
        id: 5,
        name: "Alex Wilson",
        avatar: "https://ui-avatars.com/api/?name=Alex+Wilson&background=128C7E&color=fff",
        lastMessage: "Call me when you're free",
        time: "12/14/23",
        unread: 0,
        online: false
    },
    {
        id: 6,
        name: "Lisa Taylor",
        avatar: "https://ui-avatars.com/api/?name=Lisa+Taylor&background=25D366&color=fff",
        lastMessage: "The project is completed",
        time: "12/13/23",
        unread: 3,
        online: true
    }
];

// Sample messages for each user
const messages = {
    1: [
        { id: 1, text: "Hey there! How are you?", time: "10:25 AM", sent: false },
        { id: 2, text: "I'm good, thanks! How about you?", time: "10:26 AM", sent: true },
        { id: 3, text: "Doing great! Just working on some projects.", time: "10:26 AM", sent: false },
        { id: 4, text: "That's awesome! Let me know if you need any help.", time: "10:27 AM", sent: true }
    ],
    2: [
        { id: 1, text: "Hi! Are we still meeting tomorrow?", time: "09:15 AM", sent: false },
        { id: 2, text: "Yes, definitely! 2 PM at the usual place?", time: "09:16 AM", sent: true },
        { id: 3, text: "Perfect! See you then 👋", time: "09:16 AM", sent: false }
    ],
    3: [
        { id: 1, text: "Thank you so much for your help with the project!", time: "Yesterday", sent: false },
        { id: 2, text: "You're welcome! Happy to help anytime.", time: "Yesterday", sent: true }
    ],
    4: [
        { id: 1, text: "Have you seen the new Marvel movie?", time: "12/15/23", sent: false },
        { id: 2, text: "Not yet! Is it good?", time: "12/15/23", sent: true },
        { id: 3, text: "Amazing! We should go watch it together.", time: "12/15/23", sent: false }
    ],
    5: [
        { id: 1, text: "Hey, call me when you're free. Need to discuss something important.", time: "12/14/23", sent: false }
    ],
    6: [
        { id: 1, text: "Great news! The project is finally completed 🎉", time: "12/13/23", sent: false },
        { id: 2, text: "That's fantastic! Great work team!", time: "12/13/23", sent: true },
        { id: 3, text: "Thanks! Couldn't have done it without you.", time: "12/13/23", sent: false }
    ]
};

let currentChatUser = null;
let isRecording = false;

// DOM Elements
const usersPage = document.getElementById('users-page');
const chatPage = document.getElementById('chat-page');
const usersList = document.getElementById('users-list');
const searchInput = document.getElementById('search-input');
const backButton = document.getElementById('back-button');
const chatUserAvatar = document.getElementById('chat-user-avatar');
const chatUserName = document.getElementById('chat-user-name');
const chatUserStatus = document.getElementById('chat-user-status');
const chatMessages = document.getElementById('chat-messages');
const chatInput = document.getElementById('chat-input');
const sendButton = document.getElementById('send-button');

// Initialize the app
function init() {
    renderUsersList(users);
    setupEventListeners();
}

// Render users list
function renderUsersList(usersArray) {
    usersList.innerHTML = '';

    usersArray.forEach(user => {
        const userElement = document.createElement('div');
        userElement.className = 'user-item';
        userElement.innerHTML = `
            <img src="${user.avatar}" alt="${user.name}" class="avatar">
            <div class="user-details">
                <div class="user-item-name">${user.name}</div>
                <div class="user-item-last-message">${user.lastMessage}</div>
            </div>
            <div class="user-meta">
                <div class="user-item-time">${user.time}</div>
                ${user.unread > 0 ? `<div class="user-item-unread">${user.unread}</div>` : ''}
            </div>
        `;

        userElement.addEventListener('click', () => openChat(user));
        usersList.appendChild(userElement);
    });
}

// Open chat with user
function openChat(user) {
    currentChatUser = user;

    // Update chat header
    chatUserAvatar.src = user.avatar;
    chatUserName.textContent = user.name;
    chatUserStatus.textContent = user.online ? 'online' : 'last seen recently';

    // Render messages
    renderMessages(messages[user.id]);

    // Switch to chat page
    usersPage.classList.remove('active');
    chatPage.classList.add('active');

    // Clear unread count
    user.unread = 0;
    renderUsersList(users);

    // Scroll to bottom of messages
    scrollToBottom();
}

// Render messages
function renderMessages(messagesArray) {
    chatMessages.innerHTML = '';

    messagesArray.forEach(message => {
        const messageElement = document.createElement('div');
        messageElement.className = `message ${message.sent ? 'sent' : 'received'}`;
        messageElement.innerHTML = `
            <div class="message-bubble">
                <div class="message-text">${message.text}</div>
                <div class="message-time">${message.time}</div>
            </div>
        `;
        chatMessages.appendChild(messageElement);
    });
}

// Send message
function sendMessage() {
    const text = chatInput.value.trim();
    if (!text || !currentChatUser) return;

    const newMessage = {
        id: Date.now(),
        text: text,
        time: getCurrentTime(),
        sent: true
    };

    // Add to messages
    if (!messages[currentChatUser.id]) {
        messages[currentChatUser.id] = [];
    }
    messages[currentChatUser.id].push(newMessage);

    // Render the new message
    const messageElement = document.createElement('div');
    messageElement.className = 'message sent';
    messageElement.innerHTML = `
        <div class="message-bubble">
            <div class="message-text">${text}</div>
            <div class="message-time">${newMessage.time}</div>
        </div>
    `;
    chatMessages.appendChild(messageElement);

    // Clear input
    chatInput.value = '';

    // Update user's last message and time
    currentChatUser.lastMessage = text;
    currentChatUser.time = 'Just now';

    // Scroll to bottom
    scrollToBottom();

    // Simulate reply after 1-3 seconds
    setTimeout(simulateReply, 1000 + Math.random() * 2000);
}

// Simulate reply from other user
function simulateReply() {
    if (!currentChatUser) return;

    const replies = [
        "That's interesting!",
        "I see what you mean",
        "Let me think about that",
        "Sounds good to me!",
        "Thanks for letting me know",
        "I'll get back to you on that",
        "Can we discuss this later?",
        "That's awesome! 😊"
    ];

    const randomReply = replies[Math.floor(Math.random() * replies.length)];

    const replyMessage = {
        id: Date.now(),
        text: randomReply,
        time: getCurrentTime(),
        sent: false
    };

    messages[currentChatUser.id].push(replyMessage);

    const messageElement = document.createElement('div');
    messageElement.className = 'message received';
    messageElement.innerHTML = `
        <div class="message-bubble">
            <div class="message-text">${randomReply}</div>
            <div class="message-time">${replyMessage.time}</div>
        </div>
    `;
    chatMessages.appendChild(messageElement);

    // Update user's last message
    currentChatUser.lastMessage = randomReply;
    currentChatUser.time = 'Just now';

    scrollToBottom();
}

// Get current time in HH:MM format
function getCurrentTime() {
    const now = new Date();
    return now.getHours().toString().padStart(2, '0') + ':' +
           now.getMinutes().toString().padStart(2, '0');
}

// Scroll to bottom of messages
function scrollToBottom() {
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Toggle between microphone and send icon
function toggleSendButton() {
    if (chatInput.value.trim()) {
        sendButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
        sendButton.classList.add('active');
    } else {
        sendButton.innerHTML = '<i class="fas fa-microphone"></i>';
        sendButton.classList.remove('active');
    }
}

// Setup event listeners
function setupEventListeners() {
    // Back button
    backButton.addEventListener('click', () => {
        chatPage.classList.remove('active');
        usersPage.classList.add('active');
        renderUsersList(users);
    });

    // Search functionality
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        const filteredUsers = users.filter(user =>
            user.name.toLowerCase().includes(searchTerm)
        );
        renderUsersList(filteredUsers);
    });

    // Send message on enter key
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Send button click
    sendButton.addEventListener('click', () => {
        if (chatInput.value.trim()) {
            sendMessage();
        } else {
            // Toggle recording state (simulated)
            isRecording = !isRecording;
            sendButton.innerHTML = isRecording ?
                '<i class="fas fa-stop"></i>' :
                '<i class="fas fa-microphone"></i>';
            sendButton.style.color = isRecording ? '#f15c6d' : '#8696a0';
        }
    });

    // Toggle send button based on input
    chatInput.addEventListener('input', toggleSendButton);

    // FAB for new chat
    document.querySelector('.fab').addEventListener('click', () => {
        alert('New chat feature would open a contact list here!');
    });
}

// Initialize the app when DOM is loaded
document.addEventListener('DOMContentLoaded', init);
