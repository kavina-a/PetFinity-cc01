<?php

// app/Observers/PetBoardingCenterObserver.php

// app/Observers/PetBoardingCenterObserver.php

namespace App\Observers;

use App\Models\PetBoardingCenter;
use App\Models\User;

class PetBoardingCenterObserver
{
    public function created(PetBoardingCenter $petBoardingCenter)
    {
        User::create([
            'name' => $petBoardingCenter->business_name, // Ensure this is not null
            'email' => $petBoardingCenter->email,
            'password' => $petBoardingCenter->password, // Ensure this is hashed
            'user_type' => 'pet_boarder',
        ]);
    }

    public function updated(PetBoardingCenter $petBoardingCenter)
    {
        User::where('email', $petBoardingCenter->email)->update([
            'name' => $petBoardingCenter->business_name, // Ensure this is not null
            'password' => $petBoardingCenter->password,
        ]);
    }
}
