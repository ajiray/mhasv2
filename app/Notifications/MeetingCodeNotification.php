<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MeetingCodeNotification extends Notification
{
    use Queueable;

    /**
     * The meeting code.
     *
     * @var string
     */
    protected $meetingCode;

    /**
     * Create a new notification instance.
     *
     * @param string $meetingCode
     */
    public function __construct($meetingCode)
    {
        $this->meetingCode = $meetingCode;
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
    public function toDatabase(object $notifiable): array
    {
        return [
            'meeting_code' => $this->getMeetingCode(),
            'message' => "Your meeting code is {$this->getMeetingCode()}",
            'timestamp' => now()->toDateTimeString(),
        ];
    }

    /**
     * Get the meeting code.
     *
     * @return string
     */
    public function getMeetingCode(): string
    {
        return $this->meetingCode;
    }
}
