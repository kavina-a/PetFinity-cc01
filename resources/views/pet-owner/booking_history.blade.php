<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
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
            overflow-x: hidden; /* Prevent horizontal overflow */
        }

        .main-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 60px;
            padding-bottom: 60px; /* Ensure content is not hidden under the fixed bottom navbar */
        }

        .content {
            width: calc(100% - 250px); /* Adjusted to accommodate sidebar */
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            margin-left: 270px; /* Ensure the content starts after the sidebar */
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 36px;
        }

        .card {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            border: 2px solid #ff6600;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card div {
            margin: 10px;
            text-align: left;
            flex: 1 1 45%; /* Adjusted for horizontal layout */
            display: flex;
            justify-content: space-between;
        }

        .card div .heading {
            font-weight: bold;
            color: #333;
            flex: 0 0 150px; /* Fixed width for labels */
        }

        .counter {
            position: absolute;
            top: -10px;
            left: -10px;
            background-color: #ff6600;
            color: white;
            font-size: 24px;
            padding: 10px 15px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .status {
            font-weight: bold;
        }

        .status.completed {
            color: green;
        }

        .status.cancelled {
            color: red;
        }

        .icon {
            font-size: 20px;
            margin-bottom: 5px;
            color: #ff6600;
        }

        .no-bookings {
            text-align: center;
            font-size: 18px;
            color: #777;
        }

        @media (max-width: 768px) {
            .content {
                padding: 10px;
                margin-left: 0;
                width: 100%; /* Full width for smaller screens */
            }

            .card {
                flex-direction: column;
                text-align: left;
            }

            .card div {
                margin: 10px 0;
                text-align: left;
                flex: 1 1 100%;
                display: block; /* Block display for small screens */
            }

            .counter {
                position: static;
                margin-bottom: 15px;
                font-size: 20px;
                padding: 5px 10px;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .content {
                padding: 10px;
                width: 100%;
                margin-top: 80px; /* Space for fixed top navbar */
            }

            .card {
                padding: 6px;
            }

            .card div {
                margin: 5px 0;
            }

            .icon {
                font-size: 18px;
            }

            .content{
                width: 550px;
            }

            .counter {
                font-size: 18px;
                padding: 5px 10px;
            }
        }

        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
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
            scrollbar-width: none;
            -ms-overflow-style: none;
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
            transition: background 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .sidebar nav a:hover {
            background-color: #ff6600;
            color: #fff;
        }

        .sidebar nav a .nav-icon {
            margin-right: 10px;
            font-size: 20px;
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
            transition: color 0.3s ease-in-out;
        }

        .navbar ul li a:hover {
            color: #ff6600;
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

            .navbar {
                display: flex;
                justify-content: center;
                position: fixed;
                bottom: 0;
                width: 100%;
                z-index: 10;
            }
        }

        @media (max-width: 480px) {
            .top-navbar {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 10;
            }

            .sidebar {
                display: none;
            }

            .content {
                margin-top: 80px; /* Space for fixed top navbar */
                margin-left:5px;
                padding: 1px;
                width: 97%;
            }

            .navbar {
                display: flex;
                justify-content: center;
                position: fixed;
                bottom: 0;
                width: 100%;
                z-index: 10;
            }
        }
    </style>
</head>

<body>

    <div class="top-navbar">
        <div class="logo">Petfinity</div>
        <div class="profile"><span>Profile</span><i class="fas fa-user"></i></div>
    </div>

    <div class="main-container">

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

        <!-- Booking History Content -->
        <div class="content">
            <h1>Booking History</h1>
            @if ($appointments->isEmpty())
            <p class="no-bookings">No completed bookings.</p>
            @else
            <div class="list-group">
                @foreach ($appointments as $index => $appointment)
                <div class="card">
                    
                    <div>
                        <span class="heading">Pet Name:</span> <span>{{ $appointment->pet_name }}</span>
                    </div>
                    <div>
                        <span class="heading">Boarding Center:</span> <span>{{ $appointment->boarding_center_name }}</span>
                    </div>
                    <div>
                        <span class="heading">Start Date:</span> <span>{{ Carbon\Carbon::parse($appointment->start_date)->format('d-m-Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="heading">End Date:</span> <span>{{ Carbon\Carbon::parse($appointment->end_date)->format('d-m-Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="heading">Check-in Time:</span> <span>{{ Carbon\Carbon::parse($appointment->check_in_time)->format('H:i') }}</span>
                    </div>
                    <div>
                        <span class="heading">Check-out Time:</span> <span>{{ Carbon\Carbon::parse($appointment->check_out_time)->format('H:i') }}</span>
                    </div>
                    <div>
                        <span class="heading">Payment Method:</span> <span>{{ $appointment->payment_method }}</span>
                    </div>
                    <div class="status {{ $appointment->status }}">
                        <span class="heading">Status:</span> <span>{{ ucfirst($appointment->status) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
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
        function toggleDropdown() {
            document.querySelector('.dropdown-btn').classList.toggle('active');
        }
    </script>
</body>

</html>