<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/css/pet_owner_css/nav.css', 'resources/css/pet_owner_css/dashboard.css'])

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #ff6600, #ff9933);
            flex-direction: column;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            width: 90%;
            max-width: 900px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 80px;
            margin-left: 200px; /* Move container to the right */
        }
        .leftSection {
            flex: 1;
            padding: 20px;
            border-right: 1px solid #ddd;
        }
        .petSection h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .petSection ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .petSection ul li {
            cursor: pointer;
            transition: transform 0.2s;
        }
        .petSection ul li:hover {
            transform: scale(1.05);
        }
        .petSection ul li img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        .addContainer {
            text-align: center;
            padding: 20px;
            border: 1px dashed #ddd;
            border-radius: 8px;
            margin-top: 20px;
        }
        .addContainer img {
            width: 100px;
            margin-bottom: 10px;
        }
        .addContainer h1 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .addContainer p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6600;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1rem;
        }

        /* CSS for the editing of a profile picture section */
        .profile-picture-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            opacity: 0.7;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 24px;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 50%;
        }

        .profile-picture-container:hover .overlay {
            opacity: 1;
        }
    </style>
</head>
<body>
    <x-sidebar-nav />

    <div class="container">
        <div class="leftSection">
            <div class="petSection">
                <h2>Your Pets</h2>
                <ul>
                    @foreach($pets as $pet)
                        <li data-pet-id="{{ $pet->id }}">
                            <a href="{{ route('pets.edit', $pet->id) }}">
                                <img src="{{ Storage::url($pet->profile_picture) }}" alt="{{ $pet->pet_name }}">
                            </a>
                        </li>
                        <br><br>
                    @endforeach
                </ul>
            </div>

            <div class="addContainer">
                <img src="{{ asset('add-pet.png') }}" alt="Add Pet">
                <h1>Add your pets</h1>
                <p>Manage your pet's profiles easily and keep their information up-to-date.</p>
                <a href="{{ route('pettype') }}" class="btn">Add Pet</a><br><br>
                <span>NOTE: You can add multiple pets.</span>
            </div>
            
        </div>
    </div>
</body>
</html>
