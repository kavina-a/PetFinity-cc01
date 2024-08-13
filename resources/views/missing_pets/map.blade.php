@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Missing Pets Map</h1>
    <div id="map" style="height: 600px;"></div>
</div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        .leaflet-popup-content img {
            width: 100%;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([6.9271, 79.8612], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var missingPets = @json($missingPets);

            missingPets.forEach(function(missingPet) {
                var petName = missingPet.pet ? missingPet.pet.name : 'Unknown Pet';
                var photoPath = missingPet.photo ? `{{ asset('storage/${missingPet.photo}') }}` : '';

                var marker = L.marker([missingPet.last_seen_location_latitude, missingPet.last_seen_location_longitude]).addTo(map);
                
                var popupContent = `
                    <strong>${petName}</strong><br>
                    <img src="${photoPath}" alt="Pet Photo"><br>
                    <strong>Last Seen:</strong> ${missingPet.last_seen_location}<br>
                    <strong>Date:</strong> ${missingPet.last_seen_date}<br>
                    <strong>Time:</strong> ${missingPet.last_seen_time}<br>
                    <strong>Features:</strong> ${missingPet.distinguishing_features}<br>
                    ${missingPet.additional_info ? '<strong>Additional Info:</strong> ' + missingPet.additional_info : ''}
                `;

                marker.bindPopup(popupContent);
            });
        });
    </script>
@endpush
