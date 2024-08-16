<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\ConversationParticipant;
use Illuminate\Support\Facades\Auth;

class ConversationList extends Component
{
    public $conversations;

    public function mount()
    {
        $this->conversations = ConversationParticipant::where('participant_id', Auth::id())
            ->where('participant_type', get_class(Auth::user()))
            ->with('conversation')
            ->get();
    }

    public function render()
    {
        return view('livewire.conversation-list');
    }
}
