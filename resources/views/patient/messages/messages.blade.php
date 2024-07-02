<x-app-layout>

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <script src="https://kit.fontawesome.com/c609c0bad9.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="chat-container">
        <div class="users-list" id="users">
            <div>
                <h1>Messages</h1>
            </div>
            <div class="actions">
                <input class="form-control" type="search" placeholder="Search"></input>
            </div>
            <br>
            <!-- Sample list of users with photos and recent messages -->
            <div class="user-item" data-username="Admin">
                <div>
                Admin
                    <div class="recent-message" id="recent-Admin"></div>
                </div>
            </div>
        </div>
        <div class="chat-box" id="chat-box">
            <div id="chat-panel-Admin" class="chat-messages">
                <!-- Chat messages for Admin -->
                <div class="others">
                    <p>Admin</p>
                    <p>Hi!</p>
                </div>
                @foreach ($messages as $message)
                    <div class="admin">
                        <tr>
                            <td><p>You</p></td>
                            <td>{{ $message->message }}</td>
                        </tr>
                    </div>
                @endforeach
            </div>

            <form method="post" action="{{ route('patient.messages.store') }}" class="chat-input">
                @csrf
                <input placeholder="Type your message..." rows="3" type="text" class="form-control" id="message" name="message" required>
                <button onclick="sendMessage()">Send</button>
            </form>
        </div>

    </div>

<script>
    let selectedUser = 'Admin'; // Default selected user

    document.addEventListener('DOMContentLoaded', function() {
        // Add click event listeners to user items
        document.querySelectorAll('.user-item').forEach(item => {
            item.addEventListener('click', function() {
                selectUser(item.dataset.username);
            });
        });

        // Select the default user
        selectUser(selectedUser);
    });

    function selectUser(username) {
        selectedUser = username;
        document.querySelectorAll('.user-item').forEach(item => {
            item.classList.remove('selected');
        });
        document.querySelector(`.user-item[data-username="${username}"]`).classList.add('selected');
        showChatPanel(username);
    }

    function sendMessage() {
        let message = document.getElementById('message').value;
        let senderName = document.getElementById('senderName').value;

        // Add the message to the selected chat panel
        let chatPanel = document.getElementById(`chat-panel-${selectedUser}`);
        let messageDiv = document.createElement('div');
        messageDiv.className = 'you'; // Assuming sender is always 'You'

        let nameP = document.createElement('p');
        nameP.textContent = 'You';

        let messageP = document.createElement('p');
        messageP.textContent = message;

        messageDiv.appendChild(nameP);
        messageDiv.appendChild(messageP);

        chatPanel.appendChild(messageDiv);

        // Update recent message display in user list
        let recentMessage = message.length > 20 ? message.substring(0, 20) + '...' : message; // Limit message length for display
        document.getElementById(`recent-${selectedUser}`).textContent = `You: ${recentMessage}`;

        // Clear the message input after sending
        document.getElementById('message').value = '';
    }

    function showChatPanel(username) {
        // Hide all chat panels
        document.querySelectorAll('.chat-messages').forEach(panel => {
            panel.style.display = 'none';
        });

        // Show the selected user's chat panel
        let chatPanel = document.getElementById(`chat-panel-${username}`);
        if (chatPanel) {
            chatPanel.style.display = 'block';
        }
    }
</script>
    
</html>
</body>
@endsection

@section('title')
    Messages
@endsection

</x-app-layout>