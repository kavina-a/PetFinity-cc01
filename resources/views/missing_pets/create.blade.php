<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Missing Pet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-family: 'Fredoka One', cursive;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004080;
        }

        .scrollable {
            max-height: 500px;
            overflow-y: auto;
        }

        #map {
            height: 300px;
            margin-bottom: 20px;
        }

        .manual-address {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Report Missing Pet</h1>
    <form method="POST" action="{{ route('missing_pets.store') }}" enctype="multipart/form-data" class="scrollable" id="missingPetForm">
        @csrf
        <div class="form-group">
            <label for="pet_id">Pet</label>
            <select name="pet_id" id="pet_id" class="form-control" required>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}">{{ $pet->pet_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="last_seen_location">Last Seen Location</label>
            <input type="text" name="last_seen_location" id="last_seen_location" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="last_seen_date">Last Seen Date</label>
            <input type="date" name="last_seen_date" id="last_seen_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="last_seen_time">Last Seen Time</label>
            <input type="time" name="last_seen_time" id="last_seen_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="distinguishing_features">Distinguishing Features</label>
            <textarea name="distinguishing_features" id="distinguishing_features" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="checkbox" id="use_map" name="use_map" onclick="toggleManualAddress()">
            <label for="use_map">Use Map to Select Location</label>
        </div>
        <div class="manual-address">
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" name="last_seen_location_latitude" id="latitude" class="form-control">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" name="last_seen_location_longitude" id="longitude" class="form-control">
            </div>
            <button type="button" class="btn btn-secondary" onclick="getLocation()">Use Current Location</button>
        </div>
        <div id="map" style="display: none;"></div>
        <button type="submit" class="btn btn-primary">Report Missing Pet</button>
    </form>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    function toggleManualAddress() {
        var checkBox = document.getElementById("use_map");
        var manualAddress = document.querySelector(".manual-address");
        var map = document.getElementById("map");

        if (checkBox.checked) {
            manualAddress.style.display = "block";
            map.style.display = "block";
            initMap();
            document.getElementById("latitude").required = true;
            document.getElementById("longitude").required = true;
        } else {
            manualAddress.style.display = "none";
            map.style.display = "none";
            document.getElementById("latitude").required = false;
            document.getElementById("longitude").required = false;
        }
    }

    function initMap() {
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        map.setView([position.coords.latitude, position.coords.longitude], 13);
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }
</script>

</body>
</html>
