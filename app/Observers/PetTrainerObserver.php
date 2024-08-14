<?php

// app/Observers/PetTrainerObserver.php

namespace App\Observers;

use App\Models\PetTrainingCenter;
use App\Models\User;

class PetTrainerObserver
{
    public function created(PetTrainingCenter $petTrainer)
    {
        User::create([
            'name' => $petTrainer->name,
            'email' => $petTrainer->email,
            'password' => $petTrainer->password, // Ensure this is hashed
            'user_type' => 'pet_trainer',
        ]);
    }

    public function updated(PetTrainingCenter $petTrainer)
    {
        User::where('email', $petTrainer->email)->update([
            'name' => $petTrainer->name,
            'password' => $petTrainer->password,
        ]);
    }
}
