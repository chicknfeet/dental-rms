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
            <div>
                <input class="form-control" type="search" placeholder="Search"  style="width: 100%; border-radius: 2rem;"></input>
            </div>
            <br>
            <!-- Sample list of users with photos and recent messages -->
            <div class="user-item" data-username="John Smith">
                <div>
                    John Smith
                    <div class="recent-message" id="recent-John Smith"></div>
                </div>
            </div>

            <div class="user-item" data-username="Emily Johnson">
                <div>
                    Emily Johnson
                    <div class="recent-message" id="recent-Emily Johnson"></div>
                </div>
            </div>
            <div class="user-item" data-username="Michael Rodriguez">
                <div>
                    Michael Rodriguez
                    <div class="recent-message" id="recent-Michael Rodriguez"></div>
                </div>
            </div>
            <div class="user-item" data-username="Sophia Brown">
                <div>
                    Sophia Brown
                    <div class="recent-message" id="recent-Sophia Brown"></div>
                </div>
            </div>
            <div class="user-item" data-username="Liam Williams">
                <div>
                    Liam Williams
                    <div class="recent-message" id="recent-Liam Williams"></div>
                </div>
            </div>
            <div class="user-item" data-username="Emma Johnson">
                <div>
                Emma Johnson
                    <div class="recent-message" id="recent-Emma Johnson"></div>
                </div>
            </div>
            <div class="user-item" data-username="Alexander Lee">
                <div>
                Alexander Lee
                    <div class="recent-message" id="recent-Alexander Lee"></div>
                </div>
            </div>
            <div class="user-item" data-username="Sophia Martinez">
                <div>
                Sophia Martinez
                    <div class="recent-message" id="recent-Sophia Martinez"></div>
                </div>
            </div>
            <div class="user-item" data-username="Noah Taylor">
                <div>
                Noah Taylor
                    <div class="recent-message" id="recent-Noah Taylor"></div>
                </div>
            </div>
            <div class="user-item" data-username="Olivia Brown">
                <div>
                Olivia Brown
                    <div class="recent-message" id="recent-Olivia Brown"></div>
                </div>
            </div>
        </div>
        <div class="chat-box" id="chat-box">
            <div id="chat-panel-John Smith" class="chat-messages">
                <!-- Chat messages for John Smith -->
                <div class="others">
                    <p>John Smith</p>
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

            <form method="post" action="{{ route('admin.messages.store') }}" class="chat-input">
                @csrf
                <input placeholder="Type your message..." rows="3" type="text" class="form-control" id="message" name="message" required>
                <button onclick="sendMessage()">Send</button>
            </form>
        </div>

    </div>

<script>
    let selectedUser = 'John Smith'; // Default selected user

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