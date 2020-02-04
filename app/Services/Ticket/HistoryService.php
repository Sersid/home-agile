<?php

namespace App\Services\Ticket;

use App\Models\Ticket\History;
use App\Services\BaseService;

/**
 * Class HistoryService
 * @package App\Services\Ticket
 */
class HistoryService extends BaseService
{
    /**
     * Добавляет запись в историю
     *
     * @param int    $ticket_id
     * @param string $date
     * @param int    $user_id
     * @param array  $old
     * @param array  $new
     *
     * @return mixed
     */
    public function add(int $ticket_id, string $date, int $user_id, array $old, array $new)
    {
        return self::create([
            'ticket_id' => $ticket_id,
            'date' => $date,
            'user_id' => $user_id,
            'old' => empty($old) ? null : json_encode($old),
            'new' => empty($new) ? null : json_encode($new),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return History::class;
    }
}
