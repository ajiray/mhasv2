<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventNotifications extends Notification
{
    use Queueable;

    protected $name;
    protected $date;
    protected $time;

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $date, $time)
    {
        $this->name = $name;
        $this->date = $date;
        $this->time = $time;
    }

    public function via($notifiable)
    {
        // Define the channels you want to use to send the notification
        return ['database']; // You can add other channels like 'mail', 'broadcast', etc.
    }

    public function toDatabase($notifiable)
    {
        return [
            'name' => $this->geteventname(),
            'date' => $this->geteventdate(),
            'time' => $this->geteventtime(),
            'message' => "A New Event is on the way: {$this->geteventname()} (Date: {$this->geteventdate()}) (Time: {$this->geteventtime()})",
            'timestamp' => now()->toDateTimeString(),
        ];
    }

    public function geteventname()
    {
        return $this->name;
    }

    public function geteventdate()
    {
        return $this->date;
    }

    public function geteventtime()
    {
        return $this->time;
    }
}
