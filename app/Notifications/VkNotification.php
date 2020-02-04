<?php

namespace App\Notifications;

use App\Channels\VkChannel;
use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

/**
 * Class VkNotification
 * @package App\Notifications
 */
abstract class VkNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ticket;

    /**
     * Create a new notification instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return !empty($notifiable->vk) ? [VkChannel::class] : [];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toVk($notifiable)
    {
        return [
            'peer_id' => $notifiable->vk,
            'message' => $this->message(),
        ];
    }

    /**
     * @return string
     */
    abstract function message();
}
