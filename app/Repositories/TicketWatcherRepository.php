<?php

namespace App\Repositories;

use App\Models\Ticket\Watcher;

/**
 * Class TicketWatcherRepository
 * @package App\Repositories
 */
class TicketWatcherRepository extends BaseRepository
{
    /**
     * @param int $ticket_id
     * @param int $user_id
     *
     * @return Watcher|null
     */
    public function getItem(int $ticket_id, int $user_id)
    {
        return self::query()->withTrashed()->where(['ticket_id' => $ticket_id, 'user_id' => $user_id])->first();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Watcher::class;
    }
}
