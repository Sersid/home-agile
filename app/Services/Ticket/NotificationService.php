<?php

namespace App\Services\Ticket;

use App\Models\Ticket\History;
use App\Models\Ticket\Notification;
use App\Repositories\Ticket\NotificationRepository;
use App\Services\BaseService;

/**
 * Class NotificationService
 * @package App\Services\Ticket
 */
class NotificationService extends BaseService
{
    /**
     * @param $ticket_id
     * @param $date
     */
    public function saveOnChanged($ticket_id, $date)
    {
        $item = (new NotificationRepository)->getByTicketId($ticket_id);
        if (empty($item)) {
            self::create([
                'ticket_id' => $ticket_id,
                'on_changed' => $date,
            ]);
        } else {
            $item->update(['on_changed' => $date]);
        }
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Notification::class;
    }
}
