<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sighting;
use App\Models\MissingPet;

class SightingSeeder extends Seeder
{
    public function run()
    {
        $missingPet = MissingPet::first();
        $petOwner = $missingPet ? $missingPet->petOwner : null;

        if ($missingPet && $petOwner && !Sighting::where('location', 'Galle')->exists()) {
            Sighting::create([
                'missing_pet_id' => $missingPet->id,
                'petowner_id' => $petOwner->id,
                'location' => 'Galle',
                'location_latitude' => 6.0328,
                'location_longitude' => 80.217,
                'description' => 'Seen near the beach',
                'sighting_date' => now(),
            ]);
        }
    }
}
