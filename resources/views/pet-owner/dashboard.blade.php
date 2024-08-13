<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/css/pet_owner_css/nav.css', 'resources/css/pet_owner_css/dashboard.css'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

        
        .lost-and-found-section {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 20px;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 30%;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body class="bg-gray-50">
    <x-sidebar-nav />

    <div class="container min-h-screen">
        <!-- Main Content -->
        <div class="content">
            <div class="header">
                <h1 class="header-title">Welcome to PetFinity</h1>
                <div class="account-info"></div>
            </div>

            <!-- My Pets Section -->
            <div class="greeting-box">
                <p>Here you can manage your pets and more.</p>
                <h3>My Pets</h3>
                <p>You don't have any pets yet.</p>
                <a href="{{ route('pettype') }}">
                    <button class="button-add-pet">Add Pet</button>
                </a>
            </div>

             <!-- Lost and Found Section -->
<div class="lost-and-found-section">
    <div class="card">
        <h2>View Map</h2>
        <p>See last seen locations of missing pets.</p>
        <a href="{{ route('missing_pets.map') }}" class="btn btn-primary">View Map</a>
    </div>
    <div class="card">
        <h2>Report Missing Pet</h2>
        <p>Report your pet as missing.</p>
        <a href="{{ route('missing_pets.create') }}" class="btn btn-primary">Report Missing Pet</a>
    </div>
    <div class="card">
        <h2>Report Sighting</h2>
        <p>Report a sighting of a missing pet.</p>
        <a href="#" class="btn btn-primary">Report Sighting</a>
    </div>
</div>
            <!-- End Lost and Found Section -->

            
            <!-- Services Section -->
            <div class="services-box">
                <h2 class="services-title">Explore Our Services</h2>
                <p>Discover amazing places for your pet. Click below to book appointments at pet boarding centers.</p>
                <a href="{{ route('boarding-centers.index') }}" class="button-view-places">View All Pet Boarding Places</a>
            </div>

             
            
            <!-- Accepted Appointments Section -->
            <div class="accepted-appointments-container">
                <h2 class="section-title">Accepted Appointments</h2>
                @if($acceptedAppointments->isEmpty())
                    <p>No accepted bookings.</p>
                @else
                    @foreach($acceptedAppointments as $appointment)
                        <div class="mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Booking Accepted for {{ $appointment->pet->name }}</h5>
                                <p class="card-text">
                                    <strong>Boarding Center:</strong> {{ $appointment->boardingcenter->name }}<br>
                                    <strong>Start Date:</strong> {{ $appointment->start_date }}<br>
                                    <strong>End Date:</strong> {{ $appointment->end_date }}<br>
                                    <strong>Check-in Time:</strong> {{ $appointment->check_in_time }}<br>
                                    <strong>Check-out Time:</strong> {{ $appointment->check_out_time }}<br>
                                    <strong>Special Notes:</strong> {{ $appointment->special_notes }}<br>
                                    <strong>Status:</strong> {{ $appointment->status }}<br>
                                    <strong>Payment Status:</strong> {{ $appointment->payment_status }}
                                </p>
                                <form action="{{ route('appointment.select-payment-method', $appointment->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="payment_method">Select Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-control">
                                            <option value="choose">choose</option>
                                            <option value="cash">Cash</option>
                                            <option value="card">Card</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Confirm Payment Method</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- End Accepted Appointments Section -->

            <!-- Pet Care Tips Section -->
            <div class="pet-care-tips-container">
                <h2 class="section-title">Pet Care Tips</h2>
                <div class="tips-card-container">
                    <div class="tips-card">
                        <i class="fas fa-bone tips-icon"></i>
                        <h3 class="tips-title">Nutrition</h3>
                        <p class="tips-description">Learn about the best diet and nutrition tips for your pet to ensure they stay healthy and active.</p>
                        <a href="https://www.aspca.org/pet-care/dog-care/dog-nutrition-tips" class="tips-link" target="_blank">Read More</a>
                    </div>
                    <div class="tips-card">
                        <i class="fas fa-cut tips-icon"></i>
                        <h3 class="tips-title">Grooming</h3>
                        <p class="tips-description">Find out how to properly groom your pet and keep them looking their best.</p>
                        <a href="https://www.akc.org/expert-advice/grooming/" class="tips-link" target="_blank">Read More</a>
                    </div>
                    <div class="tips-card">
                        <i class="fas fa-dog tips-icon"></i>
                        <h3 class="tips-title">Training</h3>
                        <p class="tips-description">Discover effective training techniques to help your pet learn new skills and behaviors.</p>
                        <a href="https://www.cesarsway.com/dog-training/" class="tips-link" target="_blank">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Community Events Section -->
            <div class="community-events-container">
                <h2 class="section-title">Community Events</h2>
                <div class="event-card-container">
                    <div class="event-card">
                        <i class="fas fa-calendar-alt event-icon"></i>
                        <h3 class="event-title">Pet Adoption Fair</h3>
                        <p class="event-description">Join us for a pet adoption fair this weekend and find your new furry friend.</p>
                        <a href="https://www.petfinder.com/events/" class="event-link" target="_blank">Learn More</a>
                    </div>
                    <div class="event-card">
                        <i class="fas fa-chalkboard-teacher event-icon"></i>
                        <h3 class="event-title">Training Workshop</h3>
                        <p class="event-description">Attend our training workshop to learn effective techniques for training your pet.</p>
                        <a href="https://www.petco.com/shop/en/petcostore/c/category/dog-training" class="event-link" target="_blank">Sign Up</a>
                    </div>
                    <div class="event-card">
                        <i class="fas fa-paw event-icon"></i>
                        <h3 class="event-title">Pet Fair</h3>
                        <p class="event-description">Don't miss the annual pet fair featuring vendors, activities, and more for your pets.</p>
                        <a href="https://www.akc.org/sports/akc-pet-fairs/" class="event-link" target="_blank">Get Details</a>
                    </div>
                </div>
            </div>
            <!-- End Community Events Section -->

          

        </div>
    </div>
    
</body>
</html>


