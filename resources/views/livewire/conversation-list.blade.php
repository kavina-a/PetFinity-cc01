<div>
    <h3>Your Conversations</h3>
    <ul>
        @foreach($conversations as $conversationParticipant)
            <li>
                <a href="#" wire:click.prevent="$emit('openConversation', {{ $conversationParticipant->conversation_id }})">
                    {{ $conversationParticipant->conversation->title ?? 'Untitled Conversation' }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
