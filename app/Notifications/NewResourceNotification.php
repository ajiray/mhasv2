<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewResourceNotification extends Notification
{
    use Queueable;

    /**
     * The resource title.
     *
     * @var string
     */
    protected $resourceTitle;
    protected $resourceCategory;
    /**
     * Create a new notification instance.
     *
     * @param string $resourceTitle
     */
    public function __construct($resourceTitle, $resourceCategory)
    {
        $this->resourceTitle = $resourceTitle;
        $this->resourceCategory = $resourceCategory;
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
            'resource_title' => $this->getResourceTitle(),
            'resource_category' => $this->getResourceCategory(),
            'message' => "A new resource has been uploaded: {$this->getResourceTitle()} (Category: {$this->getResourceCategory()})",
            'timestamp' => now()->toDateTimeString(),
        ];
    }

    /**
     * Get the resource title.
     *
     * @return string
     */
    public function getResourceTitle(): string
    {
        return $this->resourceTitle;
    }

    public function getResourceCategory(): string
    {
        return $this->resourceCategory;
    }
}
