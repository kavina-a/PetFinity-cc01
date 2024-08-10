<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Login Controller for Pet Owner, Pet Boarding Center, and Pet Training Center
class LoginController extends Controller
{
    //* Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }


    //* Login the user
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        
    
        if (Auth::guard('petowner')->attempt($credentials, $remember)) {
            $user = Auth::guard('petowner')->user(); // Use the specific guard
            $pets = Pet::where('petowner_id', $user->id)->get();
            // return redirect()->route('pet-owner.showpets');

            $acceptedAppointments = Appointment::where('petowner_id', Auth::id())
                                           ->where('status', 'accepted')
                                           ->where('payment_status', 'pending')
                                           ->with(['boardingcenter', 'pet'])
                                           ->get();

            return view('pet-owner.dashboard', compact('pets', 'acceptedAppointments'));

        } elseif (Auth::guard('boardingcenter')->attempt($credentials, $remember)) {
            return redirect()->route('pet-boardingcenter.dashboard');
        } elseif (Auth::guard('trainingcenter')->attempt($credentials, $remember)) {
            return redirect()->route('pet-trainingcenter.dashboard');
        }
    
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // public function showpets() {
    //         $pets = Pet::where('petowner_id', Auth::guard('petowner')->id())->get();
    //         return view('pet-owner.dashboard', compact('pets'));
    // }

    
    //* Logout the user
    public function logout(Request $request)
    {
        Auth::guard('petowner')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
