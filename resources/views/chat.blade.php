<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body>
    <div class="container">
        <h1>Chat</h1>
        <div>
            <livewire:conversation-list />
            <livewire:chat-box />
        </div>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Optional: Add some custom JavaScript to handle scrolling, etc. -->
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('openConversation', function () {
                const messagesDiv = document.getElementById('messages');
                if (messagesDiv) {
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                }
            });
        });
    </script>
</body>
</html>
