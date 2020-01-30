<?php

namespace App\Repositories;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketRepository
 * @package App\Repositories
 */
class TicketRepository extends BaseRepository
{
    /**
     * @param null|integer $id
     *
     * @return Builder[]|Collection
     */
    public function getForAgile($id = null)
    {
        return $this->query()
            ->select(['id', 'title', 'agile_id', 'priority', 'status'])
            ->withCount('comments')
            ->where('agile_id', $id)
            ->whereIn('status',
                [
                    Ticket::STATUS_NEW,
                    Ticket::STATUS_IN_WORK,
                    Ticket::STATUS_BLOCKED,
                    Ticket::STATUS_DONE,
                ])
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Builder|Model|object|null
     */
    public function getForShow(int $id)
    {
        return $this->query()
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
            ->find($id);
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Ticket::class;
    }
}
