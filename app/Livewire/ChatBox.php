<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class ChatBox extends Component
{
    public $conversationId;
    public $messages;
    public $message;

    protected $listeners = ['openConversation'];

    // This method is needed to handle the event
    public function openConversation($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->messages = Message::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage()
    {
        $newMessage = Message::create([
            'conversation_id' => $this->conversationId,
            'sender_id' => Auth::id(),
            'sender_type' => get_class(Auth::user()),
            'receiver_id' => $this->getReceiverId(),
            'receiver_type' => $this->getReceiverType(),
            'message' => $this->message,
        ]);

        $this->messages->push($newMessage);
        $this->message = '';
    }

    private function getReceiverId()
    {
        $conversation = Conversation::find($this->conversationId);
        $participant = $conversation->participants->firstWhere('participant_id', '!=', Auth::id());

        return $participant->participant_id;
    }

    private function getReceiverType()
    {
        $conversation = Conversation::find($this->conversationId);
        $participant = $conversation->participants->firstWhere('participant_id', '!=', Auth::id());

        return $participant->participant_type;
    }

    public function render()
    {
        return view('livewire.chat-box');
    }
}
