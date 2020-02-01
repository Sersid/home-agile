<?php

namespace App\Repositories;

use App\Models\Ticket\Ticket;

/**
 * Class TicketRepository
 * @package App\Repositories
 */
class TicketRepository extends BaseRepository
{
    /**
     * @param null|integer $id
     *
     * @return array
     */
    public function getForAgile($id = null)
    {
        return $this->query()
            ->select(['id', 'title', 'agile_id', 'priority', 'status', 'executor_id', 'term'])
            ->withCount('comments')
            ->where('agile_id', $id)
            ->whereIn('status',
                [
                    Ticket::STATUS_NEW,
                    Ticket::STATUS_IN_WORK,
                    Ticket::STATUS_BLOCKED,
                    Ticket::STATUS_DONE,
                ])
            ->get()
            ->toArray();
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getForShow(int $id)
    {
        $item = $this->query()
            ->select([
                'id',
                'title',
                'description',
                'agile_id',
                'status',
                'priority',
                'term',
                'executor_id',
                'created_at',
                'created_user_id',
                'updated_at',
                'updated_user_id',
            ])
            ->withCount('watch as is_watch')
            ->find($id)
            ->toArray();
        if (!empty($item)) {
            $item['is_watch'] = (bool)$item['is_watch'];
        }
        return $item;
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Ticket::class;
    }
}
