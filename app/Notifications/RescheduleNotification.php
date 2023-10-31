<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RescheduleNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $role, public string $appointment_id, public int $client_user_id)
    {
        $this->role = $role;
        $this->appointment_id = $appointment_id;
        $this->client_user_id = $client_user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'reschedule',
            'role' => $this->role,
            'appointment_id' => $this->appointment_id,
            'client_user_id' => $this->client_user_id,
        ];
    }
}
