<div>
    <h3>Chat</h3>
    @if($messages)
        <div id="messages">
            @foreach($messages as $message)
                <div>
                    <strong>{{ $message->sender->name }}:</strong> {{ $message->message }}
                </div>
            @endforeach
        </div>
    @else
        <p>Select a conversation to start chatting.</p>
    @endif

    @if($conversationId)
        <form wire:submit.prevent="sendMessage">
            <input type="text" wire:model="message" placeholder="Type your message..." />
            <button type="submit">Send</button>
        </form>
    @endif
</div>
