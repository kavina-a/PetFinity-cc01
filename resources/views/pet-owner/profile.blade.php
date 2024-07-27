<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ff6600, #ff9933);
            color: #333;
            overflow: hidden;
        }

        .container-main {
            display: flex;
            flex-direction: row;
            max-width: 1495px;
            width: 100%;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            height: calc(100vh - 100px); /* Adjust height to fit the viewport */
            overflow-y: auto; /* Enable vertical scrolling */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none; /* Hide scrollbar for Internet Explorer and Edge */
        }

        .container-main::-webkit-scrollbar {
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
            text-decoration: none;
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

        .container-form {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 70px; /* Add margin to push content below the top navbar */
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            color: #fff;
            background-color: #ff6600;
            border-color: #ff6600;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #cc5200;
        }

        .error {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
        }

        .header-title {
            font-family: 'Fredoka One', cursive;
            font-size: 40px;
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="top-navbar">
        <div class="logo">Petfinity</div>
        <a href="{{ route('pet-owner.profile.edit')}}" class="profile">
            <div class="profile"><span>Profile</span><i class="fas fa-user"></i></div>
        </a>
    </div>

    <div class="container-main min-h-screen">
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
            <div class="container-form mt-5">
                <form method="POST" enctype="multipart/form-data" action="{{ route('pet-owner.profile.update') }}" id="updateForm">
                    @csrf
                    @method('PUT')
                    <div class="section active" id="section1">
                        <h2>Update Profile</h2>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input id="first_name" class="form-input" type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required autofocus autocomplete="first_name" />
                            @error('first_name') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" class="form-input" type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required autocomplete="last_name" />
                            @error('last_name') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input id="email" class="form-input" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                            @error('email') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input id="phone_number" class="form-input" type="tel" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required autocomplete="tel" />
                            @error('phone_number') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="pets_owned">Pets Owned</label>
                            <input id="pets_owned" class="form-input" type="number" name="pets_owned" value="{{ old('pets_owned', $user->pets_owned) }}" required />
                            @error('pets_owned') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="referral_source">Referral Source</label>
                            <div class="block w-full mt-1">
                                <label>
                                    <input type="radio" name="referral_source" value="friend" {{ old('referral_source', $user->referral_source) == 'friend' ? 'checked' : '' }}> Friend 
                                </label><br>
                                <label>
                                    <input type="radio" name="referral_source" value="onlinesearch" {{ old('referral_source', $user->referral_source) == 'onlinesearch' ? 'checked' : '' }}> Online Search
                                </label><br>
                                <label>
                                    <input type="radio" name="referral_source" value="socialmedia" {{ old('referral_source', $user->referral_source) == 'socialmedia' ? 'checked' : '' }}> Social Media
                                </label><br>
                                <label>
                                    <input type="radio" name="referral_source" value="advertisement" {{ old('referral_source', $user->referral_source) == 'advertisement' ? 'checked' : '' }}> Advertisement
                                </label><br>
                                <label>
                                    <input type="radio" name="referral_source" value="other" {{ old('referral_source', $user->referral_source) == 'other' ? 'checked' : '' }}> Other
                                </label><br>
                            </div>
                            @error('referral_source') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        <div class="flex justify-center form-group">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>

                    <div class="section" id="section2">
                        <h2>Change Password</h2>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" class="form-input" type="password" name="password" autocomplete="new-password" />
                            @error('password') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" autocomplete="new-password" />
                            @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        <div class="flex justify-center form-group">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </form>
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

</body>
</html>
