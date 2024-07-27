<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Boarding Centers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
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
            overflow-x: hidden;
        }

        .main-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 60px;
            padding-bottom: 60px;
        }

        .content {
            width: calc(100% - 270px);
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 1;
            margin-left: 270px;
            margin-top: 60px;
        }

        h1 {
            text-align: center;
            color: #ff6600;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 36px;
        }

        .card {
            background: linear-gradient(135deg, #ffcc80, #ffb74d);
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(45deg);
            transition: all 0.5s;
            z-index: 1;
        }

        .card:hover::before {
            left: 100%;
            top: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            z-index: 2;
        }

        .card-body {
            padding: 20px;
            text-align: center;
            z-index: 3;
            position: relative;
        }

        .card-title {
            font-family: 'Nunito', sans-serif;
            font-size: 24px;
            color: #ff4000;
        }

        .card-text {
            font-size: 16px;
            color: #333;
        }

        .card-text span {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #ff6600;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #cc5200;
            transform: translateY(-2px);
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
            top: 60px;
            left: 0;
            padding-top: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 10;
            transition: all 0.3s ease-in-out;
            border-radius: 10px;
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
                padding-bottom: 60px;
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
                margin-top: 60px;
                margin-left: 0;
                padding: 10px;
                width: 100%;
                padding-bottom: 60px; /* Space for fixed bottom navbar */
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

        <!-- Pet Boarding Centers Content -->
        <div class="content">
         
            <div class="row g-4"> <!-- Added g-4 for spacing between cards -->
                @foreach ($boardingCenters as $center)
                    <div class="mb-4 col-md-4">
                        <div class="card">
                            @if(isset($center->photos[0]))
                                <img src="{{ Storage::url($center->photos[0]) }}" alt="Facility Photo">
                            @else
                                <img src="placeholder-image.jpg" alt="No Image Available">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ strtoupper($center->business_name) }}</h5>
                                <p class="card-text"><span>Operating Hours:</span> {{ $center->operating_hours }}</p>
                                <p class="card-text"><span>City:</span> {{ $center->city }}</p>
                                <a href="{{ route('boarding-centers.show', $center->id) }}" class="btn btn-primary">View More Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>