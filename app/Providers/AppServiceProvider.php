<?php

// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PetOwner;
use App\Models\PetBoardingCenter;
use App\Models\PetTrainingCenter;
use App\Observers\PetOwnerObserver;
use App\Observers\PetBoardingCenterObserver;
use App\Observers\PetTrainerObserver;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        PetOwner::observe(PetOwnerObserver::class);
        PetBoardingCenter::observe(PetBoardingCenterObserver::class);
        PetTrainingCenter::observe(PetTrainerObserver::class);
    }
}

