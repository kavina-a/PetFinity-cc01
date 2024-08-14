<?php

namespace App\Observers;

use App\Models\PetOwner;
use App\Models\User;

class PetOwnerObserver
{
    public function created(PetOwner $petOwner)
    {
        User::create([
            'name' => $petOwner->first_name . ' ' . $petOwner->last_name,
            'email' => $petOwner->email,
            'password' => $petOwner->password, // Ensure this is hashed
            'user_type' => 'pet_owner',
        ]);
    }

    public function updated(PetOwner $petOwner)
    {
        User::where('email', $petOwner->email)->update([
            'name' => $petOwner->first_name . ' ' . $petOwner->last_name,
            'password' => $petOwner->password,
        ]);
    }
}
