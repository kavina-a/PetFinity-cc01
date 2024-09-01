<?php

use App\Models\Pet;
use App\Models\PetBoardingCenter;
use App\Models\PetTrainingCenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetOwnerController;
use App\Http\Controllers\UpcomingController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\PendingBookingsController;
use App\Http\Controllers\PetBoardingCenterController;
use App\Http\Controllers\PetTrainingCenterController;
use App\Http\Controllers\BoardingCenterDisplayController;
use App\Http\Controllers\BoardingCenterDashboardController;
use App\Http\Controllers\PetBoardingProfileController;
use App\Providers\Filament\BoardingCenterPanelProvider;
use App\Http\Controllers\PetOwnerProfileController;
use App\Http\Controllers\PetTrainingProfileController;


//chat route
Route::middleware(['auth:petowner,boardingcenter,trainingcenter'])->group(function () {
    Route::get('/chat', function () {
        return view('chat');
    })->name('chat');
});

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ChatController;

//Route::get('/start-conversation', [ConversationController::class, 'create'])->name('conversation.create');
//Route::post('/start-conversation', [ConversationController::class, 'store'])->name('conversation.store');
//Route::get('/chat', [ChatController::class, 'index'])->name('chat');

Route::middleware(['auth:petowner,boardingcenter,trainingcenter'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/start-conversation', [ConversationController::class, 'create'])->name('conversation.create');
    Route::post('/start-conversation', [ConversationController::class, 'store'])->name('conversation.store');
});







// Auth::routes(['verify' => true]);

//* Landing Page Routes start here
Route::get('/', function () {
    return view('landing-page.welcome');
}); //landing page

Route::get('Boarding', function () {
    return view('landing-page.boarding');
})->name('Boarding'); //boarding page

Route::get('training', function () {
    return view('landing-page.training');
})->name('training'); //training page

Route::get('lostandfound', function () {
    return view('landing-page.lostandfound');
})->name('lostandfound'); //lost and found page

Route::get('/features', function () {
    return view('landing-page.features');
}); //features page


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//*login page 
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

//*choosing the role the user wants to register as :
Route::get('choose-role', [UserTypeController::class, 'index'])->name('select-role');
Route::post('choose-role', [UserTypeController::class , 'store'])->name('user-type.store'); 

//register as pet owner
Route::get('pet-owner/register', [PetOwnerController::class, 'showRegistrationForm'])->name('pet-owner.register');
Route::post('pet-owner/register', [PetOwnerController::class, 'register']);

//register as pet boarding center
Route::get('pet-boardingcenter/register', [PetBoardingCenterController::class, 'showRegistrationForm'])->name('pet-boardingcenter.register');
Route::post('pet-boardingcenter/register', [PetBoardingCenterController::class, 'register']);

//register as pet training center
Route::get('pet-trainingcenter/register', [PetTrainingCenterController::class, 'showRegistrationForm'])->name('pet-trainingcenter.register');
Route::post('pet-trainingcenter/register', [PetTrainingCenterController::class, 'register']);


//!MIDDLEWARE FOR PET OWNER
Route::middleware(['auth:petowner'])->group(function () {

    //petowner dashboard
    Route::get('petowner/dashboard', [PetOwnerController::class, 'index'])->name('pet-owner.dashboard');

    //*petowner pet profile
    Route::get('mypets', [PetController::class, 'addpetform'])->name('mypets'); // section which says add a pet and the pets you currently have
    Route::get('pet-type', [PetController::class, 'pettype'])->name('pettype'); // section which asks the user to select a pet type
    Route::get('/pets/create', [PetController::class, 'create'])->name('pet.create'); //section which asks the user to input the pet details
    Route::post('/pets', [PetController::class, 'store'])->name('pet.store'); //section that store the pet details


    //*edit pet profile
    Route::get('/pets/{id}', [PetController::class, 'show']); // Fetch pet details
    Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit'); // Show edit form
    Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update'); // Update pet information


    //*pet owner appointment routes
    Route::get('/boarding-centers', [BoardingCenterDisplayController::class, 'index'])->name('boarding-centers.index'); // Show all boarding centers
    Route::get('/boarding-centers/{id}', [BoardingCenterDisplayController::class, 'show'])->name('boarding-centers.show'); // Show a specific boarding center
    Route::get('/booking/{boardingCenterId}', [AppointmentController::class, 'create'])->name('booking.create'); // Show booking form
    Route::post('/booking', [AppointmentController::class, 'store'])->name('booking.store'); // Store booking information
    Route::get('/upcoming', [UpcomingController::class, 'index'])->name('appointments.upcoming'); // Show upcoming appointments
    Route::get('/history', [BookingHistoryController::class, 'index'])->name('appointments.history'); // Show appointment history


    //*pet owner profile 
    Route::get('/pet-owner/profile', [PetOwnerProfileController::class, 'edit'])->name('pet-owner.profile.edit'); // Show profile edit form
    Route::put('/pet-owner/profile', [PetOwnerProfileController::class, 'update'])->name('pet-owner.profile.update'); // Update profile information


    //* Route to get accepted appointments for pet owners
    Route::get('/pet-owner/accepted-appointments', [AppointmentController::class, 'showAcceptedAppointments'])->name('pet-owner.accepted-appointments');

    //* Route to show the accepted appointments for pet owners
    Route::get('/petowner/dashboard', [AppointmentController::class, 'showAcceptedAppointments'])->name('pet-owner.dashboard');

    //* Route to handle payment selection
    Route::post('/appointment/{id}/select-payment-method', [AppointmentController::class, 'selectPaymentMethod'])->name('appointment.select-payment-method');


    //chat routes
    //Route::get('/start-conversation', [ConversationController::class, 'create'])->name('conversation.create');
    //Route::post('/start-conversation', [ConversationController::class, 'store'])->name('conversation.store');
    


});

//!MIDDLEWARE FOR PET TRAINING CENTER
Route::middleware(['auth:trainingcenter'])->group(function () {
    Route::get('training/dashboard', [PetTrainingCenterController::class, 'index'])->name('pet-trainingcenter.dashboard');
    
    Route::get('/training-center/profile', [PetTrainingProfileController::class, 'edit'])->name('training-center.profile');
    Route::put('/training-center/profile/update', [PetTrainingProfileController::class, 'update'])->name('training-center-profile.update');
});


//!MIDDLEWARE FOR PET BOARDING CENTER
Route::middleware(['auth:boardingcenter'])->group(function () {

    //pet boarding center dashboard
    Route::get('petboardingcenter/dashboard', [PetBoardingCenterController::class, 'index'])->name('pet-boardingcenter.dashboard');

    //*pet boarding center's pending requests & approval and decline requests
    Route::get('/petboardingcenter/pendingrequests', [BoardingCenterDashboardController::class, 'pendingbookings'])->name('pet-boardingcenter.pendingbookings'); // Show pending requests
    Route::post('/booking/accept/{id}', [PendingBookingsController::class, 'accept'])->name('appointment.accept'); // Accept booking request
    Route::post('/booking/decline/{id}', [PendingBookingsController::class, 'decline'])->name('appointment.decline'); // Decline booking request

    //*pet boarding center's upcoming appointments
    Route::get('/boarding-center/upcoming-appointments', [UpcomingController::class, 'boardingCenterIndex'])->name('boarding-center.upcoming');

    //*pet boarding center's pet profiles
    Route::get('/boarding-center/pet-profiles', [BoardingCenterDashboardController::class, 'petProfiles'])->name('boarding-center.pet-profiles');

    //*pet boarding center's appointment history
    Route::get('/boarding-center/appointment-history', [BookingHistoryController::class, 'boardingCenterIndex'])->name('boarding-center.appointment-history');

    //*pet boarding center's profile
    Route::get('/boarding-center/profile', [PetBoardingProfileController::class, 'edit'])->name('boarding-center.profile'); // Show profile edit form
    Route::put('/boarding-center/profile/update', [PetBoardingProfileController::class, 'update'])->name('profile.update'); // Update profile information

});

