<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MigrateExistingUsersToUsersTable extends Migration
{
    public function up()
    {
        // Migrate Pet Owners
        $petOwners = DB::table('pet_owners')->get();
        foreach ($petOwners as $petOwner) {
            User::create([
                'name' => $petOwner->first_name . ' ' . $petOwner->last_name, // Combine first and last names
                'email' => $petOwner->email,
                'password' => $petOwner->password, // Ensure this is hashed
                'user_type' => 'pet_owner',
            ]);
        }

        // Migrate Pet Boarding Centers
        $petBoardingCenters = DB::table('pet_boarding_centers')->get();
        foreach ($petBoardingCenters as $petBoardingCenter) {
            User::create([
                'name' => $petBoardingCenter->business_name,
                'email' => $petBoardingCenter->email,
                'password' => $petBoardingCenter->password, // Ensure this is hashed
                'user_type' => 'pet_boarder',
            ]);
        }

        // Migrate Pet Trainers
        $petTrainers = DB::table('pet_training_centers')->get();
        foreach ($petTrainers as $petTrainer) {
            User::create([
                'name' => $petTrainer->business_name,
                'email' => $petTrainer->email,
                'password' => $petTrainer->password, // Ensure this is hashed
                'user_type' => 'pet_trainer',
            ]);
        }
    }

    public function down()
    {
        DB::table('users')->whereIn('user_type', ['pet_owner', 'pet_boarder', 'pet_trainer'])->delete();
    }
}

