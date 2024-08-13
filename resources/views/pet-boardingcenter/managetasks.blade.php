@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Tasks for Appointment with {{ $appointment->pet->pet_name }}</h2>

    <div class="mb-4 card">
        <div class="card-header">
            Appointment Details
        </div>
        <div class="card-body">
            <p><strong>Boarding Center:</strong> {{ $appointment->boardingcenter->business_name }}</p>
            <p><strong>Check-in Time:</strong> {{ $appointment->check_in_time }}</p>
            <p><strong>Check-out Time:</strong> {{ $appointment->check_out_time }}</p>
            <p><strong>Special Notes:</strong> {{ $appointment->special_notes }}</p>
        </div>
    </div>

    <div class="mb-4 card">
        <div class="card-header">
            Tasks
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($tasks as $task)
                    <li class="list-group-item">
                        <form action="{{ route('task-completions.store', $appointment) }}" method="POST">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="task{{ $task->id }}" name="completed_at" value="{{ now() }}">
                                <label class="form-check-label" for="task{{ $task->id }}">
                                    {{ $task->name }}
                                </label>
                            </div>
                            <textarea name="notes" class="mt-2 form-control" placeholder="Add any notes here..."></textarea>
                            <button type="submit" class="mt-2 btn btn-success">Mark as Completed</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
