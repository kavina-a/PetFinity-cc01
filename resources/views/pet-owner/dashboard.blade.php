<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ff6600, #ff9933);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            color: #333;
            overflow: hidden;
        }

        .container {
            display: flex;
            flex-direction: row;
            max-width: 1495px;
            width: 100%;
            margin: 50px auto;
            padding: 20px;
            background: linear-gradient(135deg, #ff6600, #ff9933);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            height: calc(100vh - 100px); /* Adjust height to fit the viewport */
            overflow-y: auto; /* Enable vertical scrolling */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none; /* Hide scrollbar for Internet Explorer and Edge */
        }

        .container::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .sidebar {
            background-color: #fff;
            width: 250px;
            height: calc(100vh - 60px);
            position: fixed;
            top: 58px;
            left: 0;
            padding-top: 20px;
            z-index: 10;
            transition: all 0.3s ease-in-out;
            border-radius: 1px;
            font-family: 'Nunito', sans-serif;
        }

        .sidebar h1 {
            font-family: 'Fredoka One', cursive;
            font-size: 32px;
            text-align: center;
            color: #ff6600;
            margin-bottom: 20px;
        }

        .sidebar nav {
            list-style: none;
            padding: 0;
            overflow-y: auto;
            height: calc(100vh - 100px);
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none; /* Hide scrollbar for Internet Explorer and Edge */
        }

        .sidebar nav::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .sidebar nav a {
            display: block;
            padding: 15px 20px;
            color: inherit;
            text-decoration: none;
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin: 0 10px;
            font-weight: bold;
            transition: background 0.3s ease-in-out, color 0.3s ease-in-out, transform 0.3s ease;
        }

        .sidebar nav a:hover {
            background-color: #ff6600;
            color: #fff;
            transform: translateY(-5px);
        }

        .sidebar nav a .nav-icon {
            margin-right: 10px;
            font-size: 20px;
        }

        .content {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none; /* Hide scrollbar for Internet Explorer and Edge */
        }

        .content::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
            overflow: hidden;
        }

        .top-navbar .logo {
            font-family: 'Fredoka One', cursive;
            font-size: 32px;
            color: #ff6600;
            margin-left: 20px;
        }

        .top-navbar .profile {
            display: flex;
            align-items: center;
            color: #333;
            cursor: pointer;
            font-size: 18px;
            margin-right: 20px;
            font-weight: bold;
        }

        .top-navbar .profile i {
            margin-left: 10px;
            font-size: 24px;
        }

        .navbar {
            display: none;
            background-color: #fff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 10;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
            padding: 0;
            margin: 0;
        }

        .navbar ul li {
            padding: 10px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.3s ease-in-out, transform 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #ff6600;
            transform: translateY(-5px);
        }

        .navbar ul li a i {
            margin-bottom: 5px;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
                margin-top: 60px;
            }

            .header {
                margin-top: 10px; /* Adjusted margin for smaller screens */
            }

            .navbar {
                display: flex;
                justify-content: center;
            }
        }

        .header {
            margin-top: 100px;
        }

        .greeting-box {
            background-color: #f7f7f7;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .greeting-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .greeting-box h2 {
            font-family: 'Fredoka One', cursive;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .greeting-box .button-add-pet {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #ff6600;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .greeting-box .button-add-pet:hover {
            background-color: #cc5200;
        }

        .services-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 10px;
        }

        .services-box {
            background-color: #f7f7f7;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .services-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .services-box p {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .services-box .button-view-places {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #ff6600;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .services-box .button-view-places:hover {
            background-color: #cc5200;
        }

        .accepted-appointments-container {
            background-color: #f7f7f7;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .accepted-appointments-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .header-title {
            font-family: 'Fredoka One', cursive;
            font-size: 40px;
            font-weight: bold;
            color: #fff;
        }

        .accepted-appointments-container .card {
            margin-bottom: 15px;
        }

        .accepted-appointments-container .card-body .card-title {
            font-size: 18px;
            font-weight: bold;
            color: #ff6600;
        }

        .accepted-appointments-container .card-body .card-text {
            font-size: 16px;
            color: #333;
        }

        .for-you-container {
            position: relative;
            background-color: #f7f7f7;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Prevent line breaks */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none; /* Hide scrollbar for Internet Explorer and Edge */
        }

        .for-you-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .for-you-container::-webkit-scrollbar {
            display: none; /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .for-you-container h2 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .video-card {
            display: inline-block; /* Make the video cards inline-block elements */
            vertical-align: top;
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-right: 20px; /* Add spacing between cards */
        }

        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .video-card img {
            width: 100%;
            height: auto;
        }

        .video-card .video-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            padding: 10px 15px;
            text-align: center;
        }

        .scroll-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            padding: 10px;
            z-index: 1;
        }

        .scroll-arrow.left {
            left: 10px;
        }

        .scroll-arrow.right {
            right: 10px;
        }

        .pet-care-tips-container {
            background-color: #f7f7f7;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }

        .pet-care-tips-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .tips-card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .tips-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .tips-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .tips-icon {
            font-size: 40px;
            color: #ff6600;
            margin-bottom: 15px;
        }

        .tips-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .tips-description {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .tips-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6600;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .tips-link:hover {
            background-color: #cc5200;
        }

        .community-events-container {
            background-color: #f7f7f7;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }

        .community-events-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .event-card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .event-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .event-icon {
            font-size: 40px;
            color: #ff6600;
            margin-bottom: 15px;
        }

        .event-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .event-description {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .event-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6600;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .event-link:hover {
            background-color: #cc5200;
        }

        .profile {
            text-decoration: none;
        }

        .button-add-pet{
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-gray-50">

    <div class="top-navbar">
        <div class="logo">Petfinity</div>
        <a href=" {{ route('pet-owner.profile.edit')}}" class="profile">
            <div class="profile"><span>Profile</span><i class="fas fa-user"></i></div>
        </a>
    </div>


    <div class="container min-h-screen">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="p-4">
                <nav class="space-y-4">
                    <a href="{{ route('pet-owner.dashboard') }}" class="nav-link">
                        <div class="nav-icon"><i class="fas fa-home"></i></div>
                        Home
                    </a>

                    <a href="{{ route('mypets') }}" class="nav-link">
                        <div class="nav-icon"><i class="fas fa-paw"></i></div>
                        Pets
                    </a>

                    <a href="{{ route('boarding-centers.index') }}" class="nav-link">
                        <div class="nav-icon"><i class="fas fa-bed"></i></div>
                        Pet Boarding Centers
                    </a>

                    <a href="{{ route('appointments.upcoming') }}" class="nav-link">
                        <div class="nav-icon"><i class="fas fa-calendar-alt"></i></div>
                        Upcoming
                    </a>

                    <a href="{{ route('appointments.history') }}" class="nav-link">
                        <div class="nav-icon"><i class="fas fa-history"></i></div>
                        Past Bookings
                    </a>

                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="content">
            <div class="header">
                <h1 class="header-title">Welcome to PetFinity</h1>
                <div class="account-info">
                   
                </div>
            </div>

            <!-- My Pets Section -->
            <div class="greeting-box">
                <p>Here you can manage your pets and more.</p>
                <h3>My Pets</h3>
                <p>You don't have any pets yet.</p>
                <a href="{{ route('pettype')}}"
                    <button class="button-add-pet">Add Pet</button>
                </a>
            </div>

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

    <div class="navbar">
        <ul>
            <li><a href="{{ route('pet-owner.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="{{ route('mypets') }}"><i class="fas fa-paw"></i> Pets</a></li>
            <li><a href="{{ route('boarding-centers.index') }}"><i class="fas fa-bed"></i> Boarding</a></li>
            <li><a href="{{ route('appointments.upcoming') }}"><i class="fas fa-calendar-alt"></i> Upcoming</a></li>
            <li><a href="{{ route('appointments.history') }}"><i class="fas fa-history"></i> History</a></li>
        </ul>
    </div>

    <script>
        function scrollLeft() {
            document.querySelector('.for-you-container').scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        }

        function scrollRight() {
            document.querySelector('.for-you-container').scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>