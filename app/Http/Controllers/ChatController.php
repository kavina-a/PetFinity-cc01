<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConversationParticipant;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = ConversationParticipant::where('participant_id', Auth::id())
            ->where('participant_type', get_class(Auth::user()))
            ->with('conversation')
            ->get();

        return view('chat', compact('conversations'));
    }
}

