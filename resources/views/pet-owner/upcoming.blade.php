<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Boarding Appointments</title>
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
            overflow: auto;
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

        .container {
            display: flex;
            flex-direction: row;
            width: 80%;
            margin-top: 70px;
            margin-left: 250px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
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
            border-radius: 1px;
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
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: inherit;
            text-decoration: none;
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

        .content {
            flex: 1;
            margin-left: 10px;
            padding: 10px;
            width:98%;
        }

        .card {
            display: flex;
            flex-direction: row;
            width:100%;
            align-items: center;
            border: 1px solid #ff6600;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 5px;
            background-color: #fff;
            margin-left: 1px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .card > div {
            flex: 1 1 auto;
            margin: 10px;
            text-align: center;
        }

        .service-type {
            background-color: #ff9933;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            min-width: 100px;
        }

        .heading {
            font-weight: bold;
            color: #333;
        }

        .countdown {
            color: green;
            min-width: 100px;
            text-align: center;
        }

        .no-appointments {
            text-align: center;
            font-size: 18px;
            color: #777;
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

        @media (max-width: 992px) {
            .container {
                flex-direction: column;
                width: 90%;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
                margin-top: 5px;
                padding: 20px 10px;
            }
            .container{
                margin-left: 5px;
            }

            .navbar {
                display: flex;
                justify-content: center;
            }
            .card.p {
                font-weight: bold;

            }

            .card {
                flex-direction: column;
                text-align: left;
                margin-left:42px;
                width: 70%;
                
            }

            .card .service-type {
                width: 80%;
                text-align: center;
                margin-bottom: 10px;
            }
            .heading {
                text-align: left;
            }


            .card .countdown {
                text-align: left;
                margin-top: 10px;
            
            }

            .card > div {
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>
<body>

    <div class="top-navbar">
        <div class="logo">Petfinity</div>
        <div class="profile"><span>Profile</span><i class="fas fa-user"></i></div>
    </div>

    <div class="container">
        <aside class="sidebar">
            <div class="p-4">
                <nav>
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

        <div class="content">
            <h1>Upcoming Boarding Appointments</h1>
            @if ($appointments->isEmpty())
                <p class="no-appointments">No upcoming boarding appointments.</p>
            @else
                <div class="list-group">
                    @foreach ($appointments as $appointment)
                        <div class="card">
                            <div class="service-type">
                                <p class="heading">Service Type</p>
                                <p>Boarding</p>
                            </div>
                            <div>
                                <p class="heading">Pet Name</p>
                                <p>{{ $appointment->pet_name }}</p>
                            </div>
                            <div>
                                <p class="heading">Boarding Center</p>
                                <p>{{ $appointment->boarding_center_name }}</p>
                            </div>
                            <div>
                                <p class="heading">Start Date</p>
                                <p>{{ Carbon\Carbon::parse($appointment->start_date)->format('d-m-Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="heading">End Date</p>
                                <p>{{ Carbon\Carbon::parse($appointment->end_date)->format('d-m-Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="heading">Check-in Time</p>
                                <p>{{ Carbon\Carbon::parse($appointment->check_in_time)->format('H:i') }}</p>
                            </div>
                            <div>
                                <p class="heading">Check-out Time</p>
                                <p>{{ Carbon\Carbon::parse($appointment->check_out_time)->format('H:i') }}</p>
                            </div>
                            <div>
                                <p class="heading">Payment Method</p>
                                <p>{{ $appointment->payment_method }}</p>
                            </div>
                            <div class="countdown">
                                <p class="heading">Countdown</p>
                                <span class="countdown-timer" data-date="{{ $appointment->start_date }}"></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="navbar">
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#"><i class="fas fa-paw"></i> Pets</a></li>
            <li><a href="#"><i class="fas fa-bed"></i> Boarding</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Upcoming</a></li>
            <li><a href="#"><i class="fas fa-history"></i> History</a></li>
        </ul>
    </div>

    <script>
        document.querySelectorAll('.countdown-timer').forEach(timer => {
            const startDate = new Date(timer.getAttribute('data-date')).getTime();
            
            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = startDate - now;
    
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    
                if (distance < 0) {
                    timer.innerHTML = "EXPIRED";
                    timer.style.color = 'red';
                } else {
                    timer.innerHTML = `${days}d ${hours}h ${minutes}m`;
    
                    // Change color based on the remaining time
                    if (distance > 48 * 60 * 60 * 1000) {
                        timer.style.color = 'green';
                    } else if (distance > 24 * 60 * 60 * 1000) {
                        timer.style.color = 'yellow';
                    } else {
                        timer.style.color = 'red';
                    }
                }
            };
    
            updateCountdown();
            setInterval(updateCountdown, 60000);
        });
    
        // Green: More than 48 hours left.
        // Yellow: Between 24 to 48 hours left.
        // Red: Less than 24 hours left.
    </script>
    

</body>
</html>