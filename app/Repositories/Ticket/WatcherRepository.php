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
     * @param int $ticket_id
     *
     * @return array
     */
    public function getWatchers(int $ticket_id): array
    {
        $result = [];
        $items = self::query()->select(['user_id'])->where(['ticket_id' => $ticket_id])->get();
        foreach ($items as $item) {
            $result[] = $item->user_id;
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Watcher::class;
    }
}
