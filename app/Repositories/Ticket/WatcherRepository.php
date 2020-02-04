<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket\Watcher;
use App\Repositories\BaseRepository;

/**
 * Class WatcherRepository
 * @package App\Repositories\Ticket
 */
class WatcherRepository extends BaseRepository
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
