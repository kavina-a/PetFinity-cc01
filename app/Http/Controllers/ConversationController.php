<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use Illuminate\Support\Facades\Auth;
use App\Models\PetBoardingCenter;

class ConversationController extends Controller
{
    
    public function create()
    {
        // Fetch all boarding centers
        $boarders = PetBoardingCenter::all(); 

        // Pass the boarding centers to the view
        return view('start-conversation', compact('boarders'));
    }

    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'boardingcenter_id' => 'required|exists:pet_boarding_centers,id',
    ]);

    // Fetch participants' names
    $petOwnerName = Auth::user()->name;
    $boardingCenterName = PetBoardingCenter::find($request->boardingcenter_id)->business_name;

    // Create a new conversation with a dynamic title
    $conversation = Conversation::create(['title' => "{$petOwnerName} & {$boardingCenterName}"]);

    // Add participants
    // Add the Pet Owner
    ConversationParticipant::create([
        'conversation_id' => $conversation->id,
        'participant_id' => Auth::id(), // Pet owner ID
        'participant_type' => 'App\Models\PetOwner',
    ]);

    // Add the Pet Boarding Center
    ConversationParticipant::create([
        'conversation_id' => $conversation->id,
        'participant_id' => $request->boardingcenter_id, // Boarder ID from form
        'participant_type' => 'App\Models\PetBoardingCenter',
    ]);

    // Redirect to the chat page
    return redirect()->route('chat');
}

}
