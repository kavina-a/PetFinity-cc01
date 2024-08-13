@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Missing Pets</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('missing_pets.map') }}" class="mb-3 btn btn-primary">View Map</a>

    @if ($missingPets->isEmpty())
        <p>No missing pets reported yet.</p>
    @else
        <div class="row">
            @foreach ($missingPets as $missingPet)
                <div class="col-md-4">
                    <div class="mb-4 card">
                        <img src="{{ Storage::url($missingPet->photo) }}" class="card-img-top" alt="Missing Pet Photo">
                        <div class="card-body">
                            <h5 class="card-title">{{ $missingPet->pet->name }}</h5>
                            <p class="card-text">
                                <strong>Last Seen:</strong> {{ $missingPet->last_seen_location }}<br>
                                <strong>Date:</strong> {{ $missingPet->last_seen_date }}<br>
                                <strong>Time:</strong> {{ $missingPet->last_seen_time }}<br>
                                <strong>Distinguishing Features:</strong> {{ $missingPet->distinguishing_features }}<br>
                                @if ($missingPet->additional_info)
                                    <strong>Additional Info:</strong> {{ $missingPet->additional_info }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
