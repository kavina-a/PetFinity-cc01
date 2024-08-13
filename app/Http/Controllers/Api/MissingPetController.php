<?php

namespace App\Http\Controllers\Api;

use App\Models\MissingPet;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MissingPetController extends Controller
{
    public function index()
    {
        $missingPets = MissingPet::with('pet')->get();
        return view('missing_pets.index', compact('missingPets'));
    }

    public function create()
    {
        $pets = Pet::where('petowner_id', Auth::id())->get();
        return view('missing_pets.create', compact('pets'));
    }

    public function store(Request $request)
{
    // Validate the common fields
    $request->validate([
        'pet_id' => 'required|exists:pets,id',
        'last_seen_location' => 'required|string',
        'last_seen_date' => 'required|date',
        'last_seen_time' => 'required',
        'distinguishing_features' => 'required|string',
        'additional_info' => 'nullable|string',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Check if the user used the map for location
    if ($request->has('use_map') && $request->use_map == 'on') {
        // Validate the latitude and longitude if map is used
        $request->validate([
            'last_seen_location_latitude' => 'required|numeric',
            'last_seen_location_longitude' => 'required|numeric',
        ]);
    }

    $data = $request->only([
        'pet_id',
        'last_seen_location',
        'last_seen_date',
        'last_seen_time',
        'distinguishing_features',
        'additional_info',
    ]);

    // Store the photo
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('missing_pets', 'public');
    }

    // Add user ID to the data
    $data['petowner_id'] = Auth::id();

    // If the map is used, add latitude and longitude to the data
    if ($request->has('use_map') && $request->use_map == 'on') {
        $data['last_seen_location_latitude'] = $request->last_seen_location_latitude;
        $data['last_seen_location_longitude'] = $request->last_seen_location_longitude;
    }

    // Attempt to create the missing pet entry
    try {
        MissingPet::create($data);
    } catch (\Exception $e) {
        Log::error('Error saving missing pet: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'There was an error saving the missing pet.']);
    }

    return redirect()->route('missing_pets.index')->with('success', 'Missing pet reported successfully.');
}
    public function map()
    {
        $missingPets = MissingPet::with('pet')->get();


    

        return view('missing_pets.map', compact('missingPets'));
    }
}

