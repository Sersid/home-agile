<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket\Notification;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationRepository
 * @package App\Repositories\Ticket
 */
class NotificationRepository extends BaseRepository
{
    /**
     * @param int $ticket_id
     *
     * @return Builder|Model|object
     */
    public function getByTicketId(int $ticket_id)
    {
        return self::query()
            ->where(['ticket_id' => $ticket_id])
            ->first();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Notification::class;
    }
}
