<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PetBoardingCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Appointment Management from booking a boarding center to payment method selection (Pet Owner's pov)
class AppointmentController extends Controller
{
    //* Booking a boarding center
    public function create($boardingCenterId)
    {
        $boardingCenter = PetBoardingCenter::findOrFail($boardingCenterId);
        
        $pets = Auth::user()->pets;

        return view('pet-owner.boardingcenter.booking', compact('boardingCenter', 'pets'));
    }

    //* Store the appointment details
    public function store(Request $request)
    {
        $request->validate([
            'boardingcenter_id' => 'required|exists:pet_boarding_centers,id',
            'pet_id' => 'required|exists:pets,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'check_in_time' => 'required|date_format:H:i',
            'check_out_time' => 'required|date_format:H:i',
            'special_notes' => 'nullable|string',
        ]);

        Appointment::create([
            'boardingcenter_id' => $request->boardingcenter_id,
            'petowner_id' => Auth::id(),
            'pet_id' => $request->pet_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
            'special_notes' => $request->special_notes,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('pet-owner.dashboard')->with('success', 'Appointment created successfully!');
    }

    //* Show accepted appointments from pet boarding center and ask for payment method 
    // public function showAcceptedAppointments()
    // {
    //     $acceptedAppointments = Appointment::where('petowner_id', Auth::id())
    //                                        ->where('status', 'accepted')
    //                                        ->where('payment_status', 'pending')
    //                                        ->with(['boardingcenter', 'pet'])
    //                                        ->get();

    //     return view('pet-owner.dashboard', compact('acceptedAppointments'));
    // }

    //* Select payment method
    public function selectPaymentMethod(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,card',
        ]);

        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method == 'cash' ? 'onvisit' : 'paid',
        ]);

        return redirect()->route('pet-owner.dashboard')->with('success', 'Payment method selected successfully.');
    }
}

