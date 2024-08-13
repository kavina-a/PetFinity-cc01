<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            background-color: #ff6600;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }
        .appointment-item {
            margin-top: 20px;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .appointment-item:last-child {
            border-bottom: none;
        }
        .appointment-header {
            font-weight: bold;
            color: #333;
        }
        .task-log {
            margin-top: 10px;
            padding-left: 20px;
        }
        .task-item {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .task-item:last-child {
            border-bottom: none;
        }
        .task-name {
            font-weight: bold;
            color: #ff6600;
        }
        .task-details {
            margin-top: 5px;
        }
        .task-notes {
            color: #666;
            font-style: italic;
        }
        .timestamp {
            color: #999;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Appointment History</h2>
        </div>

        @foreach($appointments as $appointment)
            <div class="appointment-item">
                <div class="appointment-header">
                    Appointment for {{ $appointment->pet->pet_name }} on {{ $appointment->start_date }} to {{ $appointment->end_date }}
                </div>
                
                <div class="task-log">
                    @if($appointment->taskCompletions->isEmpty())
                        <p>No tasks completed for this appointment.</p>
                    @else
                        @foreach($appointment->taskCompletions as $taskCompletion)
                            <div class="task-item">
                                <div class="task-name">{{ $taskCompletion->task->name }}</div>
                                <div class="task-details">
                                    <span class="timestamp">{{ $taskCompletion->completed_at }}</span>
                                    @if($taskCompletion->notes)
                                        <div class="task-notes">Notes: {{ $taskCompletion->notes }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
