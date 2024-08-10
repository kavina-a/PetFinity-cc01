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
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            background: linear-gradient(135deg, #ff6600, #ff9933);
            margin: 0;
            padding: 20px;
        }
        .fixed-container {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 200px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            z-index: 1000;
        }
        .navigation-button, .btn {
            padding: 10px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .navigation-button:hover, .btn:hover {
            background-color: #e0e0e0;
        }
        .btn-danger {
            background-color: #d33;
            color: white;
        }
        .btn-danger:hover {
            background-color: #b22;
        }
        .container {
            width: 100%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-right: 250px; /* Space for fixed container */
            overflow-y: auto;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-section h2 {
            margin-bottom: 10px;
        }
        .form-section .field {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <x-sidebar-nav />

    <div class="fixed-container">
        <div class="navigation-button" onclick="scrollToSection('basicInfo')">Basic Information</div>
        <div class="navigation-button" onclick="scrollToSection('physicalDetails')">Physical Details</div>
        <div class="navigation-button" onclick="scrollToSection('healthDetails')">Health Details</div>
        <div class="navigation-button" onclick="scrollToSection('behaviorDetails')">Behavior Details</div>
        <button type="submit" form="petForm" class="btn">Save</button>
        <button type="button" onclick="confirmDelete()" class="btn btn-danger">Delete</button>
    </div>

    <div class="container">
        <form id="petForm" method="POST" enctype="multipart/form-data" action="{{ route('pets.update', $pet->id) }}">
            @csrf
            @method('PUT')

            <!-- Form Fields -->

            <div class="mt-4">
                <div class="profile-picture-container">
                    <img id="profilePicturePreview" src="{{ $pet->profile_picture ? asset('storage/' . $pet->profile_picture) : 'default-image-path' }}" alt="Profile Picture" class="profile-picture">
                    <div class="overlay" onclick="document.getElementById('profilePictureInput').click();">
                        <i class="fas fa-plus"></i>
                    </div> 
                    <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" style="display: none;" onchange="previewImage(event)">
                </div>
            </div>
            
            {{-- <div class="mt-4">
                <label for="profile_picture" class="upload-icon">Upload a picture</label>
                <input type="file" id="photos" name="profile_picture" accept="image/*">
            </div> --}}

            <div class="mt-4">
                <label for="pet_name">Pet Name</label>
                <input id="pet_name" value="{{ $pet->pet_name }}" class="block w-full mt-1" type="text" name="pet_name" placeholder="Enter pet's name" />
            </div>

            <div class="mt-4">
                <label for="breed">Breed</label>
                <input id="breed" value="{{ $pet->breed }}" class="block w-full mt-1" type="text" name="breed" placeholder="Enter pet's breed" />
            </div>

            <div class="form-group mt-4">
                <label>Do you know your pet's age?</label>
                <div class="toggle-switch">
                    <input type="radio" name="know_age" id="toggle-no" value="no" {{ $pet->age && !is_numeric($pet->age) ? 'checked' : '' }} onclick="toggleAgeInputs('no')">
                    <label for="toggle-no">No</label>
                    <input type="radio" name="know_age" id="toggle-yes" value="yes" {{ $pet->age && is_numeric($pet->age) ? 'checked' : '' }} onclick="toggleAgeInputs('yes')">
                    <label for="toggle-yes">Yes</label>
                </div>
            </div>
            
            <div id="input-for-no" class="conditional-input mt-4" style="display: none;">
                <label for="estimatedAge">Estimated Age</label>
                <select class="form-control" id="estimatedAge" name="estimated_age">
                    <option value="< 6 months" {{ $pet->age == '< 6 months' ? 'selected' : '' }}> < 6 months </option>
                    <option value="6-12 months" {{ $pet->age == '6-12 months' ? 'selected' : '' }}> 6 - 12 months </option>
                    <option value="1-2 years" {{ $pet->age == '1-2 years' ? 'selected' : '' }}>1 - 2 years</option>
                    <option value="2-4 years" {{ $pet->age == '2-4 years' ? 'selected' : '' }}>2 - 4 years</option>
                    <option value="4-6 years" {{ $pet->age == '4-6 years' ? 'selected' : '' }}>4 - 6 years</option>
                    <option value="6-8 years" {{ $pet->age == '6-8 years' ? 'selected' : '' }}>6 - 8 years</option>
                    <option value="8-10 years" {{ $pet->age == '8-10 years' ? 'selected' : '' }}>8 - 10 years</option>
                    <option value="10-15 years" {{ $pet->age == '10-15 years' ? 'selected' : '' }}>10 - 15 years</option>
                    <option value="> 15 years" {{ $pet->age == '> 15 years' ? 'selected' : '' }}> > 15 years</option>
                </select>
            </div>
            
            <div id="input-for-yes" class="conditional-input mt-4" style="display: none;">
                <label for="age">Exact Age (in years)</label>
                <input type="number" step="0.1" class="form-control" id="age" name="exact_age" value="{{ is_numeric($pet->age) ? $pet->age : '' }}" placeholder="Enter pet's age in years">
            </div>            

            <div class="mt-4">
                <label for="isCastrated">Is Castrated</label>
                <select id="isCastrated" class="block w-full mt-1" name="is_castrated">
                    <option value="not_specified" {{ $pet->is_castrated == 'not_specified' ? 'selected' : '' }}>Not specified</option>
                    <option value="yes" {{ $pet->is_castrated == 'yes' ? 'selected' : '' }}>Yes</option>
                    <option value="no" {{ $pet->is_castrated == 'no' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mt-4">
                <label for="gender">Gender</label>
                <select id="gender" class="block w-full mt-1" name="gender">
                    <option value="male" {{ $pet->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $pet->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="mt-4">
                <label for="weight">Weight (in kg)</label>
                <input id="weight" value="{{ $pet->weight }}" class="block w-full mt-1" type="number" step="0.1" name="weight" placeholder="Enter pet's weight" />
            </div>

            <div class="mt-4">
                <label for="height">Height (in cm)</label>
                <input id="height" value="{{ $pet->height }}" class="block w-full mt-1" type="number" step="0.1" name="height" placeholder="Enter pet's height" />
            </div>

            <div class="mt-4">
                <label for="medicalConditions">Medical Conditions</label>
                <div class="block w-full mt-1">
                    @foreach(['allergies', 'arthritis', 'diabetes', 'epilepsy', 'heart_disease', 'hip_dysplasia', 'respiratory_issues', 'skin_conditions', 'kidney_disease', 'felv'] as $condition)
                        <label>
                            <input type="checkbox" name="medical_conditions[]" value="{{ $condition }}" {{ in_array($condition, explode(', ', $pet->medical_conditions)) ? 'checked' : '' }}> {{ ucfirst(str_replace('_', ' ', $condition)) }}
                        </label><br>
                    @endforeach
                </div>

                @php
                    $medicalConditionsArray = explode(', ', $pet->medical_conditions);
                    $otherMedicalConditions = array_pop($medicalConditionsArray); // Get the last element
                @endphp

                <div class="mt-4">
                    <label for="otherMedicalConditions">Other Medical Conditions</label>
                    <textarea id="medicalConditions" class="block w-full mt-1" name="other_medical_conditions" rows="3" placeholder="Enter any other medical conditions">{{ $otherMedicalConditions }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <label for="dietaryRestrictions">Dietary Restrictions</label>
                <div class="block w-full mt-1">
                    @foreach(['grain_free', 'gluten_free', 'low_fat', 'high_protein', 'no_chicken', 'no_beef', 'hypoallergenic', 'raw_diet', 'vegan'] as $restriction)
                        <label>
                            <input type="checkbox" name="dietary_restrictions[]" value="{{ $restriction }}" {{ in_array($restriction, explode(', ', $pet->dietary_restrictions)) ? 'checked' : '' }}> {{ ucfirst(str_replace('_', ' ', $restriction)) }}
                        </label><br>
                    @endforeach
                </div>

                @php
                $dietary_restrictions = explode(', ', $pet->dietary_restrictions);
                $other_dietary_restrictions = array_pop($dietary_restrictions); // Get the last element
                @endphp

                <div class="mt-4">
                    <label for="otherDietaryRestrictions">Other Dietary Restrictions</label>
                    <textarea id="dietaryRestrictions" class="block w-full mt-1" name="other_dietary_restrictions" rows="3" placeholder="Enter any other dietary restrictions">{{ $other_dietary_restrictions }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <label for="behavioralNotes">Behavioral Notes (optional)</label>
                <div class="block w-full mt-1">
                    @foreach(['aggression', 'anxiety', 'fearfulness', 'hyperactivity', 'house_training_issues', 'leash_training', 'separation_anxiety'] as $behavior)
                        <label>
                            <input type="checkbox" name="behavioral_notes[]" value="{{ $behavior }}" {{ in_array($behavior, explode(', ', $pet->behavioral_notes)) ? 'checked' : '' }}> {{ ucfirst(str_replace('_', ' ', $behavior)) }}
                        </label><br>
                    @endforeach
                </div>

                @php
                $behavioral_notes = explode(', ', $pet->behavioral_notes);
                $other_behavioral_notes = array_pop($behavioral_notes); // Get the last element
                @endphp

                <div class="mt-4">
                    <label for="otherBehavioralNotes">Other Behavioral Notes</label>
                    <textarea id="behavioralNotes" class="block w-full mt-1" name="other_behavioral_notes" rows="3" placeholder="Enter any other behavioral notes">{{ $other_behavioral_notes }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn ms-4">Save</button>
            </div>
        </form>
    </div>

    <script>
        // function for scrolling to a section
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.scrollIntoView({ behavior: 'smooth' });
        }

        // function to delete a pet
        function confirmDelete() {
            Swal.fire({
                title: `Are you sure you want to delete {{ $pet->pet_name }}?`,
                text: "This action cannot be undone. Please think twice!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep my pet',
                customClass: {
                    popup: 'swal2-popup-custom',
                    title: 'swal2-title-custom',
                    confirmButton: 'swal2-confirm-button-custom',
                    cancelButton: 'swal2-cancel-button-custom'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelled',
                        text: `{{ $pet->pet_name }} is safe and sound!`,
                        icon: 'success',
                        customClass: {
                            popup: 'swal2-popup-custom',
                            title: 'swal2-title-custom'
                        }
                    });
                }
            });
        }

        function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profilePicturePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

        // Toggle between age inputs based on the selected radio button
        function toggleAgeInputs(option) {
        document.getElementById('input-for-no').style.display = option === 'no' ? '' : 'none';
        document.getElementById('input-for-yes').style.display = option === 'yes' ? '' : 'none';
    }

    // Initialize the state of the inputs on page load
    document.addEventListener('DOMContentLoaded', function() {
        const knowAge = '{{ $pet->age }}';
        if (knowAge && !isNaN(knowAge)) {
            document.getElementById('toggle-yes').checked = true;
            document.getElementById('input-for-yes').style.display = '';
        } else if (knowAge) {
            document.getElementById('toggle-no').checked = true;
            document.getElementById('input-for-no').style.display = '';
        }
    });


    </script>
</body>
</html>
