<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket\History;
use App\Repositories\BaseRepository;

/**
 * Class HistoryRepository
 * @package App\Repositories\Ticket
 */
class HistoryRepository extends BaseRepository
{
    /**
     * @param int    $ticket_id
     * @param string|null $notified_at
     *
     * @return array
     */
    public function getChanges(int $ticket_id, $notified_at = null)
    {
        $user_id = null;
        $key = 0;
        $result = [];
        $query = $this->query()
            ->select(['ticket_id', 'user_id', 'old', 'new'])
            ->where(['ticket_id' => $ticket_id])
            ->orderBy('id', 'asc');

        if (!empty($notified_at)) {
            $query->where('date', '>', $notified_at);
        }

        /** @var History $item */
        foreach ($query->get() as $item) {
            if (is_null($user_id)) {
                $user_id = $item->user_id;
            }
            if ($user_id != $item->user_id) {
                $user_id = $item->user_id;
                $key++;
            }
            if (empty($result[$key])) {
                $result[$key]['user_id'] = $item->user_id;
                $result[$key]['old'] = $item->getOldDecode();
                $result[$key]['new'] = $item->getNewDecode();
            } else {
                $result[$key]['new'] = array_merge($result[$key]['new'], $item->getNewDecode());
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return History::class;
    }
}
