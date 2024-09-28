<x-app-layout>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body>
    <div class="chat-container">
        <div class="users-list" id="users">
            <div>
                <h1><i class="fa-regular fa-comment-dots"></i> Messages</h1>
            </div>
            <form action="{{ route('admin.messages.search') }}" method="GET">
                <div class="relative w-full">
                    <input type="text" name="query" placeholder="Search" class="w-full h-10 px-3 rounded-full focus:ring-2 border border-gray-300 focus:outline-none focus:border-blue-500">
                    <button type="submit" class="absolute top-0 end-0 p-2.5 pr-3 text-sm font-medium h-full text-white bg-blue-700 rounded-e-full border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </form>
            <br>
            @foreach ($users as $user)
                @if ($user->usertype !== 'dentistrystudent')
                    <div class="user-item" data-username="{{ $user->name }}" data-userid="{{ $user->id }}">
                        <div>
                            {{ $user->name }}
                            <div class="recent-message" id="recent-{{ $user->name }}"></div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="chat-box" id="chat-box">
            @foreach ($users as $user)
                @if ($user->usertype !== 'dentistrystudent')
                    <div id="chat-panel-{{ $user->name }}" class="chat-messages">
                        <!-- Chat messages for {{ $user->name }} -->
                        @foreach ($messages as $message)
                            @if ($message->sender_id == auth()->id() && $message->recipient_id == $user->id)
                                <div class="admin">
                                    <p>You</p>
                                    <p>{{ $message->message }}</p>
                                    </div>
                            @elseif ($message->sender_id == $user->id && $message->recipient_id == auth()->id())
                                <div class="others">
                                    <p>{{ $user->name }}</p>
                                    <p>{{ $message->message }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach

            <form method="post" action="{{ route('admin.messages.store') }}" class="chat-input">
                @csrf
                <input type="hidden" id="recipient_id" name="recipient_id" value="">
                <input placeholder="Type your message..." rows="3" type="text" class="form-control" id="message" name="message" required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedUser = localStorage.getItem('selectedUser');

            // Add click event listeners to user items
            document.querySelectorAll('.user-item').forEach(item => {
                item.addEventListener('click', function() {
                    selectUser(item.dataset.username, item.dataset.userid);
                });
            });

            // Select the default user or the last selected user
            if (selectedUser) {
                let userItem = document.querySelector(`.user-item[data-username="${selectedUser}"]`);
                if (userItem) {
                    selectUser(userItem.dataset.username, userItem.dataset.userid);
                }
            } else {
                let firstUser = document.querySelector('.user-item');
                if (firstUser) {
                    selectUser(firstUser.dataset.username, firstUser.dataset.userid);
                }
            }

            // Handle form submission
            document.getElementById('chat-form').addEventListener('submit', function(e) {
                e.preventDefault();
                let form = this;
                let formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addMessageToChat({
                            sender_id: '{{ auth()->id() }}',
                            sender_name: 'You',
                            message: formData.get('message'),
                            recipient_id: formData.get('recipient_id')
                        });
                        updateChatList({
                            sender_id: formData.get('recipient_id'),
                            message: formData.get('message')
                        });
                        form.reset();
                    } else {
                        console.error('Error sending message:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        function selectUser(username, userid) {
            localStorage.setItem('selectedUser', username);
            document.querySelectorAll('.user-item').forEach(item => {
                item.classList.remove('selected');
            });
            let selectedUserItem = document.querySelector(`.user-item[data-username="${username}"]`);
            if (selectedUserItem) {
                selectedUserItem.classList.add('selected');
                showChatPanel(username);
                // Set the recipient_id in the form
                document.getElementById('recipient_id').value = userid;
            }
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
                chatPanel.scrollTop = chatPanel.scrollHeight;
            } 
        }
    </script>
</body>
</html>

@section('title')
    Messages
@endsection

</x-app-layout>