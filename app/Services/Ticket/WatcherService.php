<?php

namespace App\Services\Ticket;

use App\Models\Ticket\Watcher;
use App\Repositories\Ticket\WatcherRepository;
use App\Services\BaseService;
use Exception;

/**
 * Class WatcherService
 * @package App\Services\Ticket
 */
class WatcherService extends BaseService
{
    /**
     * @param int      $ticket_id
     * @param int|null $user_id
     *
     * @return bool
     */
    public function watch(int $ticket_id, int $user_id)
    {
        $item = (new WatcherRepository)->getItem($ticket_id, $user_id);
        if (!empty($item)) {
            if ($item->trashed()) {
                $item->restore();
            }
            return true;
        }
        self::create([
            'ticket_id' => $ticket_id,
            'user_id' => $user_id,
        ]);
        return true;
    }

    /**
     * @param int $ticket_id
     * @param int $user_id
     *
     * @return bool
     */
    public function unwatch(int $ticket_id, int $user_id)
    {
        $item = (new WatcherRepository)->getItem($ticket_id, $user_id);
        if (empty($item)) {
            return true;
        }
        if (!$item->trashed()) {
            try {
                $item->delete();
            } catch (Exception $e) {
                return false;
            }
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Watcher::class;
    }
}
