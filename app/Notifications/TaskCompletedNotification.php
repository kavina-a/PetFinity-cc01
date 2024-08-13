<?php

namespace App\Notifications;

use App\Models\TaskCompletion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCompletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $taskCompletion;

    public function __construct(TaskCompletion $taskCompletion)
    {
        $this->taskCompletion = $taskCompletion;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A task has been completed for your pet.')
                    ->action('View Details', url('/'))
                    ->line('Thank you for using Petfinity!');
    }

    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->taskCompletion->task_id,
            'task_name' => $this->taskCompletion->task->name,
            'completed_at' => $this->taskCompletion->completed_at->format('Y-m-d H:i'),
            'notes' => $this->taskCompletion->notes,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'task_id' => $this->taskCompletion->task_id,
            'task_name' => $this->taskCompletion->task->name,
            'completed_at' => $this->taskCompletion->completed_at->format('Y-m-d H:i'),
            'notes' => $this->taskCompletion->notes,
        ]);
    }
}
