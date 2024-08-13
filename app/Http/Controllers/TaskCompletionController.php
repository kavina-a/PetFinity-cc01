<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\TaskCompletion;
use App\Events\PetStatusUpdated;
use App\Notifications\TaskCompletedNotification;
use Illuminate\Http\Request;

class TaskCompletionController extends Controller
{
    public function store(Request $request, Appointment $appointment)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'completed_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $taskCompletion = TaskCompletion::create([
            'appointment_id' => $appointment->id,
            'task_id' => $request->task_id,
            'completed_at' => $request->completed_at,
            'notes' => $request->notes,
        ]);

        // Trigger the PetStatusUpdated event
        event(new PetStatusUpdated($taskCompletion));

        // Notify the pet owner
        $appointment->load('petowner');
        $appointment->petowner->notify(new TaskCompletedNotification($taskCompletion));


        // Notify the pet owner
        // $appointment = Appointment::with('petowner')->findOrFail($appointment->id);
        // $appointment->petowner->notify(new TaskCompletedNotification($taskCompletion));

        return back()->with('success', 'Task marked as completed!');
    }
}
